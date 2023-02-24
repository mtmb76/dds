<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Evento;

class TemaController extends Controller
{
    public function index(Request $request){

        $temas = Tema::where('unidade_id', auth()->user()->unidade_id)->skip(100)->take(100)->Paginate(10);

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return view('temalist', compact('temas', 'unidades'));
    }

    public function consulta(Request $request){

        $temas = Tema::where('descricao','like','%'. $request->descricao .'%')->
                       where('unidade_id', auth()->user()->unidade_id)->skip(100)->take(100)->Paginate(10);
        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return view('temalist', compact('temas', 'unidades'));
    }

    public function open(Request $request){

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return view('tema', compact('unidades'));
    }

    public function add(Request $request)    
    {
        $credentials = $request->validate([
            'descricao'   => ['required'],
        ]);

        $busca = Tema::where('descricao', 'like', trim($request->descricao))->
                       where('unidade_id', auth()->user()->unidade_id)->get();

        if( $busca->count() === 0 ){

            if ($request->arquivo) {
                $arquivo = $request->arquivo->store('unidade' . auth()->user()->unidade_id);
            } else {
                $arquivo = '';
            }            
            
            $tema = Tema::create([
                'descricao'     => trim($request->descricao),
                'unidade_id'    => auth()->user()->unidade_id,
                'user_id'       => auth()->user()->id,
                'arquivo'       => $arquivo,
            ]);

            $sucesso = 'Registro cadastrado com sucesso...';

        }else{
            return back()->withErrors([
                'descricao' => 'Este tema já está cadastrado.',
            ])->onlyInput('descricao');
        }

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return view('tema', compact('unidades','sucesso'));
    }

    public function edit($id)
    {
        $campos = Tema::where('id', $id)->where('unidade_id', auth()->user()->unidade_id)->first();

        if ($campos->count() === 0) {
            return back()->withErrors([
                'descricao' => 'Tema não localizado para edição.',
            ])->onlyInput('descricao');
        }

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return view('temaedit', compact('unidades','campos', 'id'));
    }

    public function update(Request $request)
    {

        if ($request->arquivo) {

            $arquivo      = $request->arquivo->store('unidade' . auth()->user()->unidade_id);

            $updateFields = [
                'descricao' => $request->descricao,
                'arquivo' => $arquivo,
            ];
            #limpa arquivo anterior
            $tema = Tema::where('id',$request->id)->first();

        if( file_exists('storage/' . $tema->arquivo) && !empty($tema->arquivo)) {
                unlink('storage/'. $tema->arquivo); 
            }
        } else {
            $updateFields = [
                'descricao' => $request->descricao,
            ];
        }

        $update = Tema::where('id', $request->id)->
                        where('unidade_id', auth()->user()->unidade_id)->
                        update($updateFields);
        if ($update === 0) {
            return back()->withErrors([
                'descricao' => 'Erro ao salvar as alterações!',
            ])->onlyInput('descricao');
        }else{
            $sucesso = 'Item alterado com sucesso...';
        }

        $campos = Tema::where('id',$request->id)->where('unidade_id', auth()->user()->unidade_id)->first();

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return view('temaedit', compact('campos','unidades','sucesso'));
    }

    public function view($id)
    {
        $campos = Tema::where('id', $id)->where('unidade_id', auth()->user()->unidade_id)->first();
        if ($campos->count() === 0) {
            return back()->withErrors([
                'descricao' => 'Tema não localizado para consulta.',
            ])->onlyInput('descricao');
        }

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return view('temaview', compact('unidades', 'campos','id'));
    }

    public function delete($id)
    {

        $jaRegistrado = Evento::where('tema_id', $id)->where('unidade_id', auth()->user()->unidade_id)->count();
        if ($jaRegistrado > 0) {
            return back()->withErrors([
                'descricao' => 'Este tema não pode ser excluído, pois possui registo em evento(s).',
            ])->onlyInput('descricao');
        }

        Tema::where('id', $id)->where('unidade_id', auth()->user()->unidade_id)->delete();

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();
        $unidades = $unidades->descricao;

        return redirect()->intended('tema/lista');
    }

}
