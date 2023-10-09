<!DOCTYPE html>
<html lang="ru-Ru">
<head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="{DESCRIPTION}" />
    <meta name="keywords" content="{KEYWORDS}" />
    <link rel="icon" type="image/png" sizes="256x256" href="{{asset('images_icon/favicon.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<header class="header">
    <a  href="/">
        <div class="header-logo">
            <span class="header-logo-left">MOON</span>
            <span class="header-logo-right">HARMONY</span>
        </div>
    </a>

    <div class="header-nav">
        <a href="/"><div class="header-nav-items">Главная</div></a>
        <a href="{{route('category.show', 1)}}"><div class="header-nav-items">Аниме</div></a>
        <a href="{{route('category.show', 2)}}"><div class="header-nav-items">Дорамы</div></a>
        <a href="{{route('category.show', 3)}}"><div class="header-nav-items">Манга</div></a>
        <a href="{{route('category.show', 4)}}"><div class="header-nav-items">AMV</div></a>
    </div>

    <img id="search-change" class="header-search" src="{{asset('images_icon/loupe.svg')}}" alt="Search" onclick="">
    @include('layouts.login')
    <div id="search-active" class="search" style="display: none;">
        <form action="{{route('article.filter_article')}}" method="GET">
            <input type="text" name="title" />
            <button type="submit">Поиск</button>
        </form>
    </div>
</header>

<div class="modal_authorization"></div>
<div class="modal_registration"></div>
<div class="modal_recovery_password"></div>
<div id="notification"></div>

<section class="content">
    @yield('content')
</section>

<footer class="footer">
    <div class="footer_copyright">
        <span class="copyright_left">COPYRIGHT &copy; 2016 – {{date('Y')}}</span>
        <span class="copyright_right">admin@moonharmony.com</span>
    </div>

    <div class="footer_links">
        <a href="/static_page/privacy_policy">Политика конфиденциальности</a>
        <a href="/static_page/site_rules">Пользовательское соглашение</a>
        <a href="/static_page/legal_information">Правовая информация</a>
        <a href="/static_page/contacts">Контакты</a>
    </div>
</footer>

<script type="text/javascript" src="{{asset('js/js_my.js')}}"></script>

</body>
</html>
