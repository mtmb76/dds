<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\User;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tema;

class UserController extends Controller
{
    # Login
    public function login(){

        if( Auth::check() && Auth()->user()->ativo === 1 ){
            return redirect('/dashboard');
        }

        Auth::logout();

        $terminais = Unidade::orderby('descricao')->get(['id', 'descricao']);

        return view('login', compact('terminais'));
    }

    #logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    #autenticar o usuaário
    public function autenticar(Request $request)
    {

        if( Auth::check() && Auth()->user()->ativo === 1){
            return redirect('/dashboard');
        }

        Auth::logout();

        $credentials = $request->validate([
            'email'       => ['required', 'email'],
            'password'    => ['required'],
            'unidade_id'  => ['required']
        ]);

        $lembrar = ($request->remember == 1)?true:false;

        if (User::where('email',  $request->email)->where('unidade_id',$request->unidade_id)->count() === 0 ) {

            $user = User::create([
                'name'          => ucwords(str_replace('.', ' ', str_replace('@localfrio.com.br', '', $request->email))),
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'unidade_id'    => $request->unidade_id,
                'grupo'         => 'ssma',
                'ativo'         => 0,
            ]);

        }

        $user = User::where('email',  $request->email)->where('unidade_id',$request->unidade_id)->first();

        if( $user->ativo === 0 ){
            return back()->withErrors([
                'email' => $user->name.', seu usuário enconta-se inativo para acesso a esta filial',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $lembrar)) {

            $request->session()->regenerate();

            $this->geraCalendarioJS();

            $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();

            $unidades = $unidades->descricao;

            $userid   = auth()->user()->id;

            return view('dashboard', compact('unidades', 'userid'));
        } else {
            return back()->withErrors([
                'email' => 'As credenciais informadas são inválidas, ou não possui acesso a unidade escolhida...',
            ])->onlyInput('email');
        }

    }

    #chamd o dashboad do usuário logado
    public function dashboard(Request $request){

        $this->geraCalendarioJS();

        $unidades    = Unidade::where('id', auth()->user()->unidade_id)->first();

        $unidades    = $unidades->descricao;

        $userid      = auth()->user()->id;

        return view('dashboard', compact('unidades', 'userid'));

    }

    public function lista(Request $request){

        $users      = User::all();

        $nomeUnidade= Unidade::where('id',Auth()->user()->unidade_id)->first('descricao');

        return view('adminlista', compact('nomeUnidade','users'));
    }

    public function consulta(Request $request){


        $users =  User::where('name' ,'like','%'. $request->name .'%')->
                        where('grupo','like','%'. $request->grupo .'%')->
                        where('ativo','like','%'. $request->ativo .'%')->
                        skip(100)->
                        take(100)->
                        Paginate(10);

        $nomeUnidade= Unidade::where('id',Auth()->user()->unidade_id)->first('descricao');

        return view('adminlista', compact('nomeUnidade','users'));
    }

    public function delete($id)
    {
        if( User::where('id', $id)->delete() ){
            $sucesso = 'Registro excluído com sucesso!';
        }else{
            return back()->withErrors([
                'email' => 'Falha ao excluir o registro...',
            ])->onlyInput('email');
        }

        $users      = User::all();

        $nomeUnidade= Unidade::where('id',Auth()->user()->unidade_id)->first('descricao');

        return view('adminlista', compact('nomeUnidade','users', 'sucesso'));

    }

    public function edit($id)
    {
        $campos = User::where('id', $id)->first();

        if ($campos->count() === 0) {
            return back()->withErrors([
                'descricao' => 'Participante não localizado para edição.',
            ])->onlyInput('descricao');
        }

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();

        $unidades = $unidades->descricao;

        return view('adminedit', compact('unidades', 'campos'));
    }

    public function update(Request $request)
    {
        $update = User::where('id', $request->id)->
                        update(['grupo'  => $request->grupo,
                                'ativo'  => $request->ativo,
                        ]);
        if ($update === 0) {
            return back()->withErrors([
                'descricao' => 'Erro ao salvar as alterações!',
            ])->onlyInput('descricao');
        } else {
            $sucesso = 'Registro alterado com sucesso...';
        }

        $campos = User::where('id', $request->id)->first();

        if ($campos->count() === 0) {
            return back()->withErrors([
                'descricao' => 'Participante não localizado para edição.',
            ])->onlyInput('descricao');
        }

        $unidades = Unidade::where('id', auth()->user()->unidade_id)->first();

        $unidades = $unidades->descricao;

        return view('adminedit', compact('unidades', 'campos','sucesso'));
    }

    public function geraCalendarioJS(){

        $data_incio  = date("Y-m-01");

        $data_fim    = date("Y-m-t");

        $eventos     = Evento::whereBetween('dia', [$data_incio, $data_fim])->
                               where('unidade_id',auth()->user()->unidade_id)->
                               orderBy('dia')->get();

        $jsonEventos = '';

        foreach ($eventos as $value) {
            switch ($value->area) {
                case 'A':
                    $area = 'Administrativo';
                    break;
                case 'O':
                    $area = 'Operacional';
                    break;
                default:
                    $area = '*';
                    break;
            }
            switch ($value->turno) {
                case '1':
                    $turno = '1º';
                    break;
                case '2':
                    $turno = '2º';
                    break;
                case '3':
                    $turno = '3º';
                    break;
                default:
                    $turno = '*';
                    break;
            }

            # adiciono um dia ao dia do evento, porque o calendário tem um bug de colcar no dia anterior
            $dia          = date('Y-m-d', strtotime("+1 days", strtotime($value->dia)));

            $descricaoTema= Tema::find($value->tema_id);

            # crio um link para visualizar o evento
            $eventName    = "<a style='font-size:14px; color:#eee089;' href='" . url('/evento/view/' . $value->id) . "'>".'Evento #'.$value->id. "</a>" .'<br>Turno: '. $turno .'<br>Setor: '. $area . '<br>Tema: ' .$descricaoTema->descricao ;

            # crio a lista de eventos
            $jsonEventos .= '{startDate: "'.$dia.'",  endDate: "'.$dia.'",  summary:"'.$eventName.'"},';

        }
        $corpo = "
            $(document).ready(function () {
                $('#container').simpleCalendar({
                    fixedStartDay: true,
                    displayYear: true,
                    disableEventDetails: false,
                    disableEmptyDetails: true,
                    months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    days: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    events: [
                    ".$jsonEventos."
                    ],
                });
            });
        ";

        $file = "js/" . auth()->user()->id . "_calendario.js";

        if( file_exists($file) ){
            if( unlink($file) ){
                $arquivo = fopen($file, "w");
                fwrite($arquivo, $corpo);
                fclose($arquivo);
                $retorno = true;
            }else{
                $retorno = false;
            }
        }else{
            $arquivo = fopen($file, "w");
            fwrite($arquivo, $corpo);
            fclose($arquivo);
            $retorno = true;
        }

        return $retorno;

    }

}
