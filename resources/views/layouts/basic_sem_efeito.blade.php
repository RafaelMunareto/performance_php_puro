<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="{{ asset('img/favicon.png') }}" rel="shortcut icon" >
        <title>@yield('title')</title>
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" ></script>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/Chart.min.css')}}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" />
        <link href="{{asset('css/estilos.css')}}" rel="stylesheet">
        <link href="{{asset('css/neomorphic.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrapPersonal.css')}}" rel="stylesheet"  type="text/css"  media="screen" >
        <link href="{{asset('css/grafico.css')}}" rel="stylesheet">
        <link href="{{asset('css/estilosMobile.css')}}" rel="stylesheet">
        <link href="{{asset('css/select.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    </head>

    <header class='neomorphic-card'>

        <nav class="navbar navbar bg neomorphic-card-inverse">
            @auth
                @if(Auth::user()->adm == 1)
                    <a class="navbar-brand buttonTransform animated-bounce-buttom"  href="{{ route('adm.abertura') }}" >
                        <h3 class='neomorphic-text-black '> Performance </h3>
                    </a>
                @endif
                @if(Auth::user()->adm == 0)
                <a class="navbar-brand buttonTransform animated-bounce-buttom"  href="{{ route('dashboard', date('m')) }}" >
                    <h3 class='neomorphic-text-black '> Performance </h3>
                </a>
                @endif
            @endAuth
            @guest
                <a class="navbar-brand buttonTransform animated-bounce-buttom"  href="{{ route('abertura')}}" >
                    <h3 class='neomorphic-text-black '> Performance </h3>
                </a>
            @endguest
            <div class='row'>
                @guest
                    <a href="{{ route('contato')}}" title="CONTATO">
                        <div class="icon-item borderRadius-20 margin-0 mr-3 buttonTransform animated-bounce-buttom">
                             <i class="fa fa-paper-plane text-blue"></i>
                        </div>
                    </a>
                @endguest
                @auth
                    @if(Auth::user()->adm == 1)
                        <a  href="{{ route('adm.abertura')}}"  title="ABERTURA">
                            <div class="icon-item borderRadius-20 margin-0 mr-3 buttonTransform ml-2 animated-bounce-buttom" >
                                <i class="fa fa-home neomorphic-text-black"></i>
                            </div>
                        </a>
                        <a href="{{ route('adm')}}" title="ADMINISTRATIVO">
                            <div class="icon-item borderRadius-20 margin-0 mr-3 buttonTransform animated-bounce-buttom">
                                <i class="fa fa-wrench neomorphic-text-black"></i>
                            </div>
                        </a>
                    @endif
                    <a href="{{ route('contato')}}" title="CONTATO">
                        <div class="icon-item borderRadius-20 margin-0 mr-3 buttonTransform animated-bounce-buttom">
                            <i class="fa fa-paper-plane text-blue"></i>
                        </div>
                    </a>

                    <a href="/sair" class="icon-link" title="SAIR">
                        <div class="icon-item borderRadius-20 margin-0 mr-3 buttonTransform animated-bounce-buttom">
                            <i  class="fa fa-door-open text-red"></i>
                        </div>
                    </a>

                @endauth

            </div>
        </nav>

    </header>

    <body>

        <div class='d-flex justify-content-between mt-3 mr-3' id='desktop' class='animated fadeIn' >
            <h2 class='neomorphic-text-black text-uppercase ml-3 w-70 size130' id='desktop' class='animated fadeIn' > @yield('titulo')</h2></span>
            <div id='desktop' class='animated fadeIn'  class='w-30'>@yield('navgation')</div>
        </div>
    </div>
        <div class='container'>
            @include('message.flash-message')
        </div>
        <div class='container-fluid margin-0'>
            @yield('conteudo')
        </div>

    </body>

    {{-- <footer  class="page-footer font-small blue pt-4 neomorphic-conc footer">

        <div class="container-fluid text-center text-md-left ">
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <h4 class="neomorphic-text-gray ml-2 ">DivFlex</h4>
                    <p class='neomorphic-text-black ml-2'>Gestão Ágil, resultados robustos</p>
                </div>
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="d-flex justify-content-around">
                    <ul class="list-unstyled size icon-list d-flex justify-content-around">

                            <li class="icon-item buttonTransform animated-bounce-buttom">
                                <a href="https://www.facebook.com/DivFlex-100716464946102" title="Follow us on Facebook">
                                    <i class="fab  fa-facebook-f"></i></a>
                            </li>
                            <li class="icon-item buttonTransform animated-bounce-buttom">
                                <a href="https://www.instagram.com/divflex/" title="Follow us on Instagram">
                                    <i class="fab  fa-instagram text-danger"></i>
                                </a>
                            </li>
                            <li class="icon-item buttonTransform animated-bounce-buttom">
                                <a href="https://twitter.com/DivFle" title="Follow us on Twitter">
                                    <i class="fab  fa-twitter"></i>
                                </a>
                            </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center size80 py-3">© 2020 Copyright:<a href="#"> DivFlex</a></div>

    </footer> --}}

</html>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/simulador.js')}}"></script>
<script type="text/javascript" src="{{asset('js/colors.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cookie.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript" src="{{asset('js/ajax.js')}}"></script>
<script type="text/javascript" src="{{asset('js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('js/selectAction.js')}}"></script>
<script type="text/javascript" src="{{asset('js/principal.js')}}"></script>






