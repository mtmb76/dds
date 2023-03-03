@extends('layouts.main')

@section('title','Temas')

<!-- Estilos customizados para esse template -->
<link href="../css/dashboard.css" rel="stylesheet">

@section('user.name')
    {{auth()->user()->name}}
@endsection

@section('user.unidade')
    {{$unidades}}
@endsection

@section('form.title')
    Consulta do Tema #{{$campos->id}}
@endsection

@section('auth.content')

  <form class="form-control mb-3" style="border: 0px transparent;" action="{{route('tema.update')}}" method="get">

    @csrf

    <div class="form-group">

        <table class="table table-striped table-hover table-sm" style="font-size: 12px;">
            <thead class="thead-dark">
                <tr>
                    <th>Unidade</th>
                    <th>Descrição</th>
                    <th>Criado em</th>
                    <th>Editado em</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$unidades}}</td>
                    <td>{{$campos->descricao}}</td>
                    <td>{{ date_format($campos->created_at,'d-m-Y H:i:s')}}</td>
                    <td>{{ date_format($campos->updated_at,'d-m-Y H:i:s')}}</td>
                </tr>
            </tbody>
        </table>

        <nav class="navbar navbar-light flex-md-nowrap p-0">
            <ul class="navbar-nav px-0">
                <li class="nav-item text-nowrap">
                    <a href="{{route('tema.lista')}}"
                        <button class="btn btn-danger"  style="width: 100px; height: 30px; font-size: 11px; font-weight: 500;" type="button">Voltar</button>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
  </form>

@endsection
