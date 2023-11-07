<header class="header">
    <nav class="menu">
        <a href="/">
            <div class="header-logo">
                <span class="header-logo-left">MOON</span>
                <span class="header-logo-right">HARMONY</span>
            </div>
        </a>
        {{--        <ul class="header-nav">--}}
        {{--            <li><a href="/">Главная</a></li>--}}
        {{--            <li><a href="{{ route('article.filter_article', ['category[]' => 1]) }}">Аниме</a></li>--}}
        {{--            <li><a href="{{ route('article.filter_article', ['category[]' => 2]) }}">Дорамы</a></li>--}}
        {{--            <li><a href="{{ route('article.filter_article', ['category[]' => 3]) }}">Манга</a></li>--}}
        {{--            <li><a href="{{ route('article.filter_article', ['category[]' => 4]) }}">AMV</a></li>--}}
        {{--        </ul>--}}
        @include('layouts.login')
        <div class="search">
            <form action="{{ route('article.filter_article') }}" method="GET">
                <input type="search" name="title" placeholder="Поиск..." />
                <button type="submit"></button>
            </form>
        </div>
    </nav>
</header>
