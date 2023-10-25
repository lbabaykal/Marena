<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="description" content="{DESCRIPTION}" />
    <link rel="icon" type="image/png" sizes="256x256" href="{{asset('images_icon/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <ul class="header-nav">
            <li><a href="/">Главная</a></li>
            <li><a href="{{route('article.filter_article', ['category[]' => 1])}}">Аниме</a></li>
            <li><a href="{{route('article.filter_article', ['category[]' => 2])}}">Дорамы</a></li>
            <li><a href="{{route('article.filter_article', ['category[]' => 3])}}">Манга</a></li>
            <li><a href="{{route('article.filter_article', ['category[]' => 4])}}">AMV</a></li>
        </ul>
        <img id="search-button" class="header-search" src="{{asset('images_icon/loupe.svg')}}" alt="Search" onclick="">
        @include('layouts.login')
    </nav>
    <div id="search" class="search">
        <form action="{{route('article.filter_article')}}" method="GET">
            <input type="search" name="title" />
            <button type="submit">Поиск</button>
        </form>
    </div>
</header>

@yield('main')

<footer class="footer">
    <div class="footer_copyright">
        <div class="header-logo">
            <span class="header-logo-left">MOON</span>
            <span class="header-logo-right">HARMONY</span>
            <span class="copyright"> &copy; 2016 – {{date('Y')}}</span>
        </div>
    </div>

    <div class="footer_links">
        <a href="/static_page/privacy_policy">Политика конфиденциальности</a>
        <a href="/static_page/site_rules">Пользовательское соглашение</a>
        <a href="/static_page/legal_information">Правовая информация</a>
        <a href="/static_page/contacts">Контакты</a>
    </div>
</footer>

<div class="modal_authorization"></div>
<div class="modal_registration"></div>
<div class="modal_recovery_password"></div>
<div id="notification"></div>

<script type="text/javascript" src="{{asset('js/js_my.js')}}"></script>
</body>
</html>
