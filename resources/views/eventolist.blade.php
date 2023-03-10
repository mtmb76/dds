@extends('layouts.main')

@section('title','Eventos')

@section('user.name')
    {{auth()->user()->name}}
@endsection

@section('user.unidade')
    {{$unidades}}
@endsection

@section('form.title')
  Listagem de Eventos
@endsection

@section('auth.content')

    <form class="form-control" style="border: 0px transparent;" action="{{route('evento.consulta')}}" name="frmEventoConsulta" method="GET">

        @csrf

        @method('GET')

        <label for="dias" style=" font-size: 12px;"><b>Pesquisa pela data entre:</b></label>
        <div id="dias" class="row">
            <div class="col-md-1 d-none d-md-block" style="width: 220px;">
                <input id="diainicio" name="diainicio" value="{{$data_inicio}}" style="width: 200px; margin-bottom: 10px; font-size: 12px;" class="form-control form-control-light p-1 mb-2" type="date" placeholder="Pesquise aqui pela data" aria-label="Pesquise aqui pela data">
            </div>
            <div class="col-md-1 d-none d-md-block" style="width: 10px;">
                e
            </div>
            <div class="col-md-1 d-none d-md-block" style="width: 220px;">
                <input id="diafim" name="diafim" value="{{$data_fim}}" style="width: 200px; margin-bottom: 10px; font-size: 12px;" class="form-control form-control-light p-1 mb-2" type="date" placeholder="Pesquise aqui pela data" aria-label="Pesquise aqui pela data">
            </div>
        </div>

        <div class="row">
            <div class="col-md-1 d-none d-md-block" style="width: 245px;">

                <label  style=" font-size: 12px;" for="turno"><b>Pesquisa pelo turno:</b></label>
                <select class="form-select form-select-sm" style="width: 200px; font-size: 12px;" name="turno" id="turno">
                    <option value="">Abra para selecionar</option>
                    <option value="1">Primeiro</option>
                    <option value="2">Segundo</option>
                    <option value="3">Terceiro</option>
                </select>

            </div>
            <div class="col-md-1 d-none d-md-block" style="width: 220px;">

                <label style=" font-size: 12px;" for="area"><b>Pesquisa pela ??rea:</b></label>
                <select class="form-select form-select-sm" style="width: 200px; margin-bottom: 10px; font-size: 12px;" name="area" id="area">
                    <option value="">Abra para selecionar</option>
                    <option value="A">Administrativa</option>
                    <option value="O">Operacional</option>
                </select>

            </div>
        </div>

        <label  style=" font-size: 12px;" for="tema"><b>Pesquisa pelo tema:</b></label>
        <select class="form-select form-select-sm" style="width: 445px; font-size: 12px;" name="tema" id="tema">
            <option value="">Selecione um tema</option>
            @foreach($temas as $cell)
                <option value="{{$cell->id}}">{{$cell->descricao}}</option>
            @endforeach
        </select>

        <ul class="navbar-nav mt-3 mb-3" style="margin-left: 0px;">
            <li class="nav-item text-nowrap">
                <button style="width: 100px; height: 30px; font-size: 11px; font-weight: 500;"  class="btn btn-info" type="submit">Pesquisar</button>
                <a href="{{route('evento.lista')}}"
                    <button style="width: 100px; height: 30px; font-size: 11px; font-weight: 500;"  class="btn btn-warning" type="button">Atualizar</button>
                </a>
                <a href="{{route('evento.novo')}}">
                    <button style="width: 100px; height: 30px; font-size: 11px; font-weight: 500;"  class="btn btn-success" type="button">Novo</button>
                </a>
            </li>
        </ul>

    </form>

    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Dia</th>
                <th>Turno</th>
                <th>??rea</th>
                <th>Tema</th>
                <th>A????es</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @if(! empty($eventos) && $eventos->count())
                @foreach ($eventos as $evento)
                    <tr>
                        <td style="width: 10%; font-weight: 600;">{{$evento->id}}</td>
                        <td style="width: 10%;">{{  date('d-m-Y',strtotime($evento->dia)) }}</td>

                        @if($evento->turno == 1)
                           <td style="width: 5%;">Primeiro</td>
                        @elseif($evento->turno == 2)
                           <td style="width: 5%;">Segundo</td>
                        @else
                           <td style="width: 5%;">Terceiro</td>
                        @endif

                        @if($evento->area == 'A')
                           <td style="width: 5%;">Administrativo</td>
                        @elseif($evento->area == 'O')
                           <td style="width: 5%;">Operacional</td>
                        @else
                           <td style="width: 5%;"></td>
                        @endif

                        <td style="width: 60%; font-weight: 500; font-size: 12px; color:cadetblue;">
                            @foreach($temas as $tema)
                                {{($tema->id == $evento->tema_id)?$tema->descricao:''}}
                            @endforeach
                        </td>

                        <td style="width: 10%; color: darkslategray">
                            <a href="/evento/view/{{$evento->id}}" style="text-decoration: none;">
                                <span data-feather="eye"></span>
                            </a>
                            &nbsp;
                            <a href="/evento/edit/{{$evento->id}}" style="text-decoration: none;">
                                <span data-feather="edit"></span>
                            </a>
                            @if(auth()->user()->grupo == 'admin')
                                &nbsp;
                                <a href="/evento/delete/{{$evento->id}}" style="text-decoration: none;">
                                    <span data-feather="trash"></span>
                                </a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>Nenhum evento cadastrado...</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{$eventos->withQueryString()->links()}}

@endsection
