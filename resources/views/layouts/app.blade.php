<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{__('Restaurant Application')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">

    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href={{ asset('vendor/font-awesome/css/font-awesome.min.css') }}>
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href={{ asset('vendor/font-awesome/css/font-awesome.min.css') }}>
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href={{ asset('css/fontastic.css') }}>
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mada&display=swap" rel="stylesheet">

    <!-- Alertity CSS-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    {{--    select 2 --}}
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />



    <!-- theme stylesheet-->
    <link rel="stylesheet" href={{ asset('css/style.default.css') }} id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href={{ asset('css/custom.css') }}>

    <!-- Favicon-->
    <link rel="shortcut icon" href={{ asset('img/favicon.ico') }}>
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    {{--    DataTable--}}
    <link href="{{ asset('css/jquery_ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTable.jqueryui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTable.scroller.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href={{ asset('css/myStyle.css') }}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"  />
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/login') }}">
                {{ str_replace( '-' , ' ' , config('app.name', 'App')) }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->

                        <li class="nav-item dropdown">

                        @if(Auth::user()->role->name === 'Admin')

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                        </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('restaurants.index') }}">{{ __('Restaurants') }}</a>
                            </li>

                        @endif

                        @if(Auth::user()->role->name === 'Employee')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('menu_items.index') }}">{{ __('Menus') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('add_qr_code') }}">{{ __('Add QR-Code') }}</a>
                        </li>

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        </li>

                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script>
<script src="{{ asset('js/app.js') }}" defer></script>
{{--<script src="vendor/jquery/jquery.min.js"></script>--}}
<script src="vendor/popper.js/umd/popper.min.js"> </script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
</body>
</html>
