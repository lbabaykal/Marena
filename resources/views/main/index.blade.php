@extends('layouts.main')
@section('title', $title)
@section('content')
    <section class="articles_main_short">
        <div class="articles_main_short_title article_title_scarlet">
            <a href="{{route('article.filter_article', ['category[]' => 1])}}">АНИМЕ</a>
        </div>
        <div class="articles_group_short">
            @foreach($articles_anime as $article)
                @include('layouts.short_article')
            @endforeach
        </div>
    </section>

    <section class="articles_main_short">
        <div class="articles_main_short_title article_title_orange">
            <a href="{{route('article.filter_article', ['category[]' => 2])}}">ДОРАМЫ</a>
        </div>
        <div class="articles_group_short">
            @foreach($articles_dorams as $article)
                @include('layouts.short_article')
            @endforeach
        </div>
    </section>
@endsection
