<?php 
use Illuminate\Support\Facades\Route;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  {{--
  <link rel="shortcut icon" href="{{asset('shreyu/dist/assets/images/favicon.ico')}}" /> --}}

  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">
  <link rel="mask-icon" href="{{asset('images/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">


  <link href="{{asset('shreyu/dist/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"
    id="bs-default-stylesheet" />
  <link href="{{asset('shreyu/dist/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"
    id="app-default-stylesheet" />

  <link href="{{asset('shreyu/dist/assets/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css"
    id="bs-dark-stylesheet" disabled />
  <link href="{{asset('shreyu/dist/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css"
    id="app-dark-stylesheet" disabled />


  <link href="{{asset('shreyu/dist/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet" type="text/css" />


  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="loading"
  data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>
  @yield('content')



  <script src="{{asset('shreyu/dist/assets/js/vendor.min.js')}}"></script>
  <script src="{{asset('shreyu/dist/assets/js/app.min.js')}}"></script>

  <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>