<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        {{----}}
        {{--<meta charset="utf-8">--}}
        {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

        {{--<!-- CSRF Token -->--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DGolden Wear Store') }}</title>

        {{--<!-- Scripts -->--}}
        {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

        {{--<!-- Fonts -->--}}
        {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
        {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}

        {{--<!-- Styles -->--}}
        {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Bootstrap Dashboard by Bootstrapious.com</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">

        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Fontastic Custom icon font-->
        <link rel="stylesheet" href="{{ asset('css/fontastic.css') }}">
        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <!-- jQuery Circle-->
        <link rel="stylesheet" href="{{ asset('css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
        <!-- Custom Scrollbar-->
        <link rel="stylesheet" href="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <!-- toaster notification -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/js/notification/toastr.css') }}">
</head>
<body>

    <!-- This is the original code -->
    <div id="app">
        @if(auth()->check())
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <main class="py-4">
            @if(auth()->check())
                @include('partials.left-sidebar')
            @endif

            <div class="page">


                <!-- Header -->

                @include('partials.top-header')

                <!-- Content  -->
                @yield('content')
            </div>
        </main>
    </div>
    <script src="/js/jquery.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Main File-->
    <script src="{{ asset('js/front.js') }}"></script>

    <!-- toaster notification -->
    <script src="{{ asset('/js/notification/toastr.min.js') }}"></script>

    <!-- vue.js files -->
    <script src="{{ asset('js/vue2.1.3.js') }}"></script>
    <!-- <script src="{{ asset('js/process-orders.js') }}"></script> -->
    <script src="{{ asset('js/axios.js') }}"></script>

    <script type="text/javascript">
        $('.link').click(function() {
            localStorage.removeItem('dealer');
        });
    </script>

    @yield('more_script')
    
</body>
</html>
