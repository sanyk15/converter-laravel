<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    @stack('page-styles')
</head>
<body
    class="@section('body-classes')vertical-layout vertical-menu-modern 2-columns footer-static menu-expanded pace-done navbar-sticky semi-dark-layout @show"
    data-open="hover"
    data-menu="vertical-menu-modern"
    data-col="2-columns"
>
@include('layouts.main.header')
@include('layouts.main.content')

@empty($exception)
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endempty

@include('layouts.main.footer')

@empty($exception)
    @stack('page-vendor-scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endempty
@stack('page-scripts')
</body>
</html>
