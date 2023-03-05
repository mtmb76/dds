
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Localfrio">
    <link rel="icon" href="{{URL::asset('/favicon.ico')}}">

    <title>@yield('title')</title>

    <!-- Estilos customizados para esse template -->
    <link href="{{URL::asset('/css/dashboard.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('/css/calendar-gc.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

    <body>

        <nav class="navbar navbar-dark fixed-top py-0 shadow" style="background-color: rgba(27,51,73,0.47);">
            <a class="navbar-brand col-sm-3 col-md-2 text-center text-white-50" style="padding-left: 5px; font-weight: 700; font-size: 22px;" href="{{route('dashboard')}}">
                <img src="{{URL::asset('img/logo.png')}}" style="max-height: 70px; max-width: 160px;" class="img-fluid" alt="localfrio">
            </a>
            <span class="p-1 text-white font-weight-bolder text-opacity-50" style="font-size: 20px; font-weight: 600; margin-right: 1%;"> DIÁLOGO DIÁRIO DE SEGURANÇA </span>

            <!--<span id="time" class="p-1 text-white font-weight-bolder" style="font-size: 12px; font-weight: 600; margin-right: 1%;"></span>-->

        </nav>

        @auth
            <div class="container">

                <div class="row">

                    <nav class="col-md-2 d-none d-md-block sidebar">

                        <div class="sidebar-sticky border-0">

                            <ul class="nav flex-column">

                                @if(Auth()->user()->grupo !== 'lider')
                                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                    <span style="font-size: 10px; font-weight: 800;">Meu Dashboard</span>
                                    <a class="d-flex align-items-center text-muted" href="{{route('dashboard')}}">
                                        <span data-feather="home" style="color: rgb(26, 118, 54);"></span>
                                    </a>
                                </h6>
                                @endif

                                @if(Auth()->user()->grupo === 'admin')
                                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                        <span>Administração</span>
                                        <a class="d-flex align-items-center text-muted" href="#">
                                            <span data-feather="more-horizontal"></span>
                                        </a>
                                    </h6>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.lista') }}">
                                            <span data-feather="key"></span>
                                            Usuários
                                        </a>
                                    </li>
                                @endif

                                @if ( Auth()->user()->grupo === 'admin' ||
                                      Auth()->user()->grupo === 'ssma'  ||
                                      Auth()->user()->grupo === 'lider')
                                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                        <span>Cadastros</span>
                                        <a class="d-flex align-items-center text-muted" href="#">
                                            <span data-feather="more-horizontal"></span>
                                        </a>
                                    </h6>

                                    @if ( Auth()->user()->grupo === 'admin' ||
                                          Auth()->user()->grupo === 'ssma'  )
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('tema.lista') }}">
                                                <span data-feather="paperclip"></span>
                                                Temas
                                            </a>
                                        </li>
                                    @endif

                                    @if ( Auth()->user()->grupo === 'admin' ||
                                          Auth()->user()->grupo === 'ssma'  ||
                                          Auth()->user()->grupo === 'lider')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('participante.lista') }}">
                                                <span data-feather="user-check"></span>
                                                Participantes
                                            </a>
                                        </li>
                                    @endif

                                    @if ( Auth()->user()->grupo === 'admin' ||
                                          Auth()->user()->grupo === 'ssma'  )
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('evento.lista') }}">
                                                <span data-feather="check-square"></span>
                                                Eventos
                                            </a>
                                        </li>
                                    @endif

                                @endif

                            </ul>

                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Sessão</span>
                            </h6>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span> {{Auth()->user()->grupo}}</span>
                                <span data-feather="users"></span>
                            </h6>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>@yield('user.name')</span>
                                <span data-feather="user"></span>
                            </h6>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span> @yield('user.unidade')</span>
                                <span data-feather="map-pin"></span>
                            </h6>
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span>Sair</span>
                                <a class="d-flex align-items-center text-muted" href="{{route('logout')}}">
                                    <span data-feather="log-out" style="color: red;"></span>
                                </a>
                            </h6>

                            <!--<div class="position-relative float-none border-2 border-dark" style="margin-top: 50px; left: 20%; width: 100px; height: 100px;">
                                <img src="{{URL::asset('img/dds.png')}}" class="img-fluid" style="width: 100px; height: 100px;" alt="localfrio">
                            </div>-->

                        </div>
                    </nav>
                </div>
            </div>

            <div class="container-fluid sticky-top overflow-auto" id="conteudo">
                <div class="pt-2 mb-2 border-bottom shadow-sm rounded-1 bg-opacity-75 bg-dark font-weight-lighter">
                    <h6 class="text-white font-weight-bolder ml-2 "> &nbsp; @yield('form.title')</h6>
                </div>
                @yield('auth.content')
            </div>
        @endauth

        @yield('content')

        @if($errors->any())
            <div id="popup" class="alert alert-danger fade show fixed-bottom" style="text-align: center; vertical-align: middle; font-size: 12px; width:50%; margin-left: 30%; margin-bottom: 60px; height: 50px;" role="alert">
                <strong>Atenção:&nbsp; </strong>
                @foreach ($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif

        @if(! empty($sucesso) )
            <div id="popup" class="alert alert-success fade show fixed-bottom"  style="text-align: center; vertical-align: middle; font-size: 12px; width:50%; margin-left: 30%; margin-bottom: 60px; height: 50px;" role="alert">
                <strong>Sucesso:&nbsp;</strong> {{$sucesso}}
            </div>
        @endif

        @if(! empty($alerta) )
            <div id="popup" class="alert alert-warning  fade show fixed-bottom" style="text-align: center; vertical-align: middle; font-size: 12px; width:50%; margin-left: 30%; margin-bottom: 60px; height: 50px;" role="alert">
                <strong>Importante:&nbsp;</strong> {{$alerta}}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center fixed-bottom p-0 shadow" style="background-color: rgba(27,51,73,0.59);">
            <div class="row w-100">
                <div class="col">
                </div>
                <div class="col text-center text-white-50">
                    <span style="font-size: 12px;">Grupo Localfrio &copy; - Todos os direitos reservados - 2023</span>
                </div>
                <div class="col">
                </div>
            </div>
        </div>

        <!-- Ícones -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        @if( !in_array('dashboard', explode( '/', Request::url())) && !in_array('autenticar', explode( '/', Request::url()))  )
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        @endif

        <script>
            feather.replace();
            setTimeout(function() {
                $('#popup').fadeIn('slow');
                $('#popup').fadeOut('slow');
            }, 3000);

            var timeDisplay = document.getElementById("time");

            function refreshTime() {
                var dateString = new Date().toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"});
                var formattedString = dateString.replace(", ", " - ");
                timeDisplay.innerHTML = formattedString;
            }

            setInterval(refreshTime, 1000);
        </script>
        <script>
            var purecookieTitle="Política de Cookies",
                purecookieDesc="Utilizamos alguns cookies para guardar informações de acesso. Clicando em 'Concordo', você aceita nossa política de proteção de seus dados.",
                purecookieLink='<a href="https://www.mpf.mp.br/servicos/lgpd/o-que-e-a-lgpd" target="_blank">Saiba mais</a>',
                purecookieButton="Concordo";
            function pureFadeIn(e,o){var i=document.getElementById(e);i.style.opacity=0,i.style.display=o||"block",function e(){var o=parseFloat(i.style.opacity);(o+=.02)>1||(i.style.opacity=o,requestAnimationFrame(e))}()}function pureFadeOut(e){var o=document.getElementById(e);o.style.opacity=1,function e(){(o.style.opacity-=.02)<0?o.style.display="none":requestAnimationFrame(e)}()}function setCookie(e,o,i){var t="";if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3),t="; expires="+n.toUTCString()}document.cookie=e+"="+(o||"")+t+"; path=/"}function getCookie(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var n=i[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; Max-Age=-99999999;"}function cookieConsent(){getCookie("purecookieDismiss")||(document.body.innerHTML+='<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><a>'+purecookieTitle+'</a></div><div class="cookieDesc"><p>'+purecookieDesc+" "+purecookieLink+'</p></div><div class="cookieButton"><a onClick="purecookieDismiss();">'+purecookieButton+"</a></div></div>",pureFadeIn("cookieConsentContainer"))}function purecookieDismiss(){setCookie("purecookieDismiss","1",7),pureFadeOut("cookieConsentContainer")}window.onload=function(){cookieConsent()};
        </script>
        <style>
            #conteudo{
                top: 8%;
                width: 83%;
                font-size: 12px;
                margin-left: 17%;
                float: none;
                position: fixed;
                overflow-y: auto;
            }

            .cookieConsentContainer{
                z-index: 999;
                width: 300px;
                height: auto;
                box-sizing: border-box;
                padding:20px 20px 20px 20px;
                background-color: rgba(35, 35, 35, 0.76);
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
                font-size:20px;
                line-height:20px;
                display:block;
            }
            .cookieConsentContainer .cookieDesc p{
                margin: 0;
                padding: 0;
                font-family: OpenSans,arial,sans-serif;
                color: white;
                font-size:10px;
                line-height:20px;
                display:block;
                margin-top:10px;
            }
            .cookieConsentContainer .cookieDesc a{
                font-family:OpenSans,arial,sans-serif;
                color: yellow;
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
    </body>

</html>
