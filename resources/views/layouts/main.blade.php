<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="description" content="{DESCRIPTION}" />
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('images_icon/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simple-notify.css') }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/simple-notify.js') }}"></script>
    <meta name="csrf-token" content="{{  csrf_token()  }}">
</head>

<body>
<header class="header">
    <nav class="menu">
        <a href="/">
            <div class="header-logo">
                <span class="header-logo-left">MOON</span>
                <span class="header-logo-right">HARMONY</span>
            </div>
        </a>

        @include('layouts.login')
    </nav>
    <div class="search">
        <form action="{{ route('article.filter_article') }}" method="GET">
            <input type="search" name="title" placeholder="Поиск..." />
            <button type="submit" style="background-image: url('{{ asset('images_icon/loupe.svg') }}');"></button>
        </form>
    </div>
</header>

@yield('main')

<script type="text/javascript" src="{{ asset('js/js_my.js') }}"></script>
</body>
</html>
