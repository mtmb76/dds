@extends('layouts.main')

@section('title','Autenticação')

@section('content')

<div class="cntr">

    <div class="box border-opacity-10 border-info align-items-center pt-2" style="background-color: rgba(255,255,255,0.07);">

        <!--<span class="font-weight-lighter text-white-50" style="font: 800 30px 'Arial Black'; -webkit-text-fill-color: transparent; -webkit-text-stroke: 1px;">
            Credenciais
        </span>-->

        <h5 class="text-opacity-50 text-white">Credenciais</h5>

        <form action="{{route('autenticar')}}" method="POST" name="loginFrm">

          @csrf

          @method('POST')

          <!-- Email input -->
          <div class="form-outline mb-2">
            <label class="form-label font-weight-normal text-white-50" style="font-weight: bold; font-size: 12px;" for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control form-control-sm"
              placeholder="Informe uma conta de usuário válida" style="height: 25px;" value="{{old('email')}}" required/>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-2">
            <label class="form-label font-weight-normal text-white-50" style="font-weight: bold; font-size: 12px;" for="paswword">Senha</label>
            <input type="password" id="paswword" name="password" class="form-control form-control-sm"
              placeholder="Informe sua senha" style="height: 25px;" value="{{old('password')}}" required/>
          </div>

          <!-- Terminal input -->
          <div class="form-outline mb-3">
            <label class="form-label font-weight-normal text-white-50" style="font-weight: bold; font-size: 12px;" for="unidade">Unidade</label>
            <select name="unidade_id" id="unidade_id" class="form-control form-control-sm" style="font-size: 12px; height: 25px;" required>
              <option value=""></option>
              @foreach ($terminais as $item)
                  <option value="{{$item->id}} {{( (int)old('unidade_id') === $item->id)?'selected':''}}"> {{$item->descricao}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-outline mb-2">
            <!-- button -->
            <button type="submit" class="btn btn-primary pt-1 mt-2 mb-2" style="width: 260px; height: 25px; font-size: 12px; font-weight: 400;"> Autenticar </button>
          </div>
          <!-- Checkbox -->
          <div class="form-outline mb-0">
            <input class="form-check-input me-2" type="checkbox" value="1" name="remember" id="remember" checked/>
            <label style="font-size: 12px;" class="form-check-label" for="remember">
              Lembrar minhas credenciais
            </label>
          </div>
        </form>
    </div>
</div>

@endsection

<style>
    input[type="text"]
    {
        background: transparent !important;
        border: none;
    }
    .cntr {
        width: 100vw;
        height: 100vh;
        background-size: cover;
        background: url('img/bg.png') no-repeat center;
        opacity: 0.9;
        z-index: -1;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .box {
        width: 300px;
        height: auto;
        background: black;
        padding: 20px 20px 20px 20px;
        border-radius: 10px 10px 10px 10px;
        border: rgb(231, 231, 231) 2px solid;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    body {
        margin: 0px;
    }
</style>
