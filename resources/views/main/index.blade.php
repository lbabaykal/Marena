@extends('layouts.main')
@section('title', config('app.name'))
@section('content')
    <div class="group_custom_articles">
        <div class="content_group_heading color-chapter-green">
            <div class="group_heading_text"><a href="{{route('category.show', 1)}}">| Аниме |</a></div>
        </div>
        <div class="group_short_article">
            @foreach($articles_anime as $article)
                @include('layouts.short_article')
            @endforeach
        </div>
    </div>

    <div class="group_custom_articles">
        <div class="content_group_heading color-chapter-orange">
            <div class="group_heading_text"><a href="{{route('category.show', 2)}}">| Дорамы |</a></div>
        </div>
        <div class="group_short_article">
            @foreach($articles_dorams as $article)
                @include('layouts.short_article')
            @endforeach
        </div>
    </div>

    <div class="group_custom_articles">
        <div class="content_group_heading color-chapter-red">
            <div class="group_heading_text"><a href="{{route('category.show', 3)}}">| Манга |</a></div>
        </div>
        <div class="group_short_article">
            @foreach($articles_manga as $article)
                @include('layouts.short_article')
            @endforeach
        </div>
    </div>
@endsection
