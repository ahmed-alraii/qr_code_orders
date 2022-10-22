<!DOCTYPE html>
<html lang="en">

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

    @yield('styles')
</head>

<body>

 @yield('content')

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script>

</body>
</html>
