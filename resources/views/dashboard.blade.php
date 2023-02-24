@extends('layouts.main')

@section('title','DDS - Dashboard')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="js/jquery.simple-calendar.js"></script>
<link rel="stylesheet" href="css/simple-calendar.css">
<script src="js/{{$userid}}_calendario.js"></script>

@section('user.name')
    {{auth()->user()->name}}
@endsection

@section('user.unidade')
    {{$unidades}}
@endsection

@section('form.title')
   <h5>Calendário de Eventos</h5>
@endsection

@section('auth.content')
    <!--<div class="py-2" style="position: fixed; width: 80%; height: 30%;" id="calendar"></div>-->
    <div id="container"></div>
@endsection
