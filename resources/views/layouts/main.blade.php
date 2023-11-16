<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="description" content="{DESCRIPTION}" />
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simple-notify.css') }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/simple-notify.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

@include('layouts.header')

@yield('main')

</body>
<script type="text/javascript" src="{{ asset('js/js_my.js') }}"></script>
</html>
