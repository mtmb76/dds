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
              placeholder="Informe uma conta de usuário válida" value="{{old('email')}}" required/>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-2">
            <label class="form-label font-weight-normal text-white-50" style="font-weight: bold; font-size: 12px;" for="paswword">Senha</label>
            <input type="password" id="paswword" name="password" class="form-control form-control-sm"
              placeholder="Informe sua senha" value="{{old('password')}}" required/>
          </div>

          <!-- Terminal input -->
          <div class="form-outline mb-2">
            <label class="form-label font-weight-normal text-white-50" style="font-weight: bold; font-size: 12px;" for="unidade">Unidade</label>
            <select name="unidade_id" id="unidade_id" class="form-control form-control-sm" style="font-size: 12px;" required>
              <option value=""></option>
              @foreach ($terminais as $item)
                  <option value="{{$item->id}} {{( (int)old('unidade_id') === $item->id)?'selected':''}}"> {{$item->descricao}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-outline mb-2">
            <!-- button -->
            <button type="submit" class="btn btn-primary pt-1 mt-2 mb-2" style="width: 260px; height: 30px; font-size: 11px; font-weight: 500;"> Autenticar </button>
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

<script>
    var purecookieTitle="Política de Cookies",
        purecookieDesc="Utilizamos alguns cookies para guardar informações de acesso. Clicando em 'Concordo', você aceita nossa política de proteção de seus dados.",
        purecookieLink='<a href="https://www.mpf.mp.br/servicos/lgpd/o-que-e-a-lgpd" target="_blank">Saiba mais</a>',
        purecookieButton="Concordo ";
    function pureFadeIn(e,o){var i=document.getElementById(e);i.style.opacity=0,i.style.display=o||"block",function e(){var o=parseFloat(i.style.opacity);(o+=.02)>1||(i.style.opacity=o,requestAnimationFrame(e))}()}function pureFadeOut(e){var o=document.getElementById(e);o.style.opacity=1,function e(){(o.style.opacity-=.02)<0?o.style.display="none":requestAnimationFrame(e)}()}function setCookie(e,o,i){var t="";if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3),t="; expires="+n.toUTCString()}document.cookie=e+"="+(o||"")+t+"; path=/"}function getCookie(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var n=i[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; Max-Age=-99999999;"}function cookieConsent(){getCookie("purecookieDismiss")||(document.body.innerHTML+='<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><a>'+purecookieTitle+'</a></div><div class="cookieDesc"><p>'+purecookieDesc+" "+purecookieLink+'</p></div><div class="cookieButton"><a onClick="purecookieDismiss();">'+purecookieButton+"</a></div></div>",pureFadeIn("cookieConsentContainer"))}function purecookieDismiss(){setCookie("purecookieDismiss","1",7),pureFadeOut("cookieConsentContainer")}window.onload=function(){cookieConsent()};
</script>

<style>

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

    .cookieConsentContainer{
        z-index: 999;
        width: 350px;
        min-height: 20px;
        box-sizing: border-box;
        padding:30px 30px 30px 30px;
        background-color: #232323;
        color: white;
        overflow:hidden;
        position:fixed;
        bottom:30px;
        right:30px;
        display:none;
        border-radius: 20px;
    }
    .cookieConsentContainer .cookieTitle a{
        font-family:OpenSans,arial,sans-serif;
        color: white;
        font-size:22px;
        line-height:20px;
        display:block;
    }
    .cookieConsentContainer .cookieDesc p{
        margin: 0;
        padding: 0;
        font-family: OpenSans,arial,sans-serif;
        color: white;
        font-size:13px;
        line-height:20px;
        display:block;
        margin-top:10px;
    }
    .cookieConsentContainer .cookieDesc a{
        font-family:OpenSans,arial,sans-serif;
        color: white;
        text-decoration:underline;
    }
    .cookieConsentContainer .cookieButton a{
        display:inline-block;
        font-family:OpenSans,arial,sans-serif;
        color: white;
        font-size:14px;
        font-weight:700;
        margin-top:14px;
        background: black;
        box-sizing: border-box;
        padding: 15px 24px;
        text-align: center;
        transition: background .3s;
        border-radius: 20px;
    }
    .cookieConsentContainer .cookieButton a:hover{
        cursor:pointer;
        background:#3e9b67;
    }
    @media (max-width:980px){
        .cookieConsentContainer{
            bottom:0!important;
            left:0!important;
            width:100%!important;
        }
    }
</style>
