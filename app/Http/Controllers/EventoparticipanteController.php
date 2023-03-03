<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Evento;
use App\Models\Participante;
use App\Models\Eventoparticipante;
use Illuminate\Support\Facades\DB;

class EventoparticipanteController extends Controller
{
    /**
     * @param $evento
     * @param $participante
     * @return RedirectResponse
     */
    public function delete($evento, $participante){

        Eventoparticipante::where('evento_id', $evento)->
                            where('participante_id', $participante)->
                            delete();

        return redirect()->intended('evento/view/'.$evento);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request)
    {
        #pesquiso primeiro pelo crachá
        $participante = Participante::where('cracha',trim($request->cracha))->first();

        if(!$participante){

            # se não achou pelo crachá, pesquisa pelo cpf
            $participante = Participante::where('cpf',trim($request->cracha))->first();

            if(!$participante){
                return back()->withErrors([
                    'cracha' => 'Crachá não localizado para inclusão!',
                ])->onlyInput('cracha');
            }
        }

        if($participante->ativo === 0){
            return back()->withErrors([
                'cracha' => 'Este participante está inativo!',
            ])->onlyInput('cracha');
        }

        $evento   = Evento::where('id', $request->evento_id)->where('unidade_id', auth()->user()->unidade_id)->first();

        # Pesquisa se participante já esteve em ALGUM evento hoje
        $eventoDia = DB::scalar('SELECT count(*)
                                          FROM eventos a,
                                               eventoparticipantes b
                                         WHERE a.dia = :dia
                                           AND b.participante_id = :participante_id
                                           AND a.id = b.evento_id
                                       ',['dia'=>$evento->dia, 'participante_id'=>$participante->id]);
        if($eventoDia !== 0){
            return back()->withErrors([
                'Error' => 'Participante já registrou presença em um DDS neste dia!',
            ])->onlyInput('Error');
        }else{
            $evento->eventoparticipante()->create([
                'unidade_id'        => auth()->user()->unidade_id,
                'evento_id'         => $request->evento_id,
                'participante_id'   => $participante->id,
                'user_id'           => auth()->user()->id,
            ]);
        }

        return redirect()->intended('evento/view/' . $request->evento_id);
    }

}
