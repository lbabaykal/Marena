@extends('layouts.main')
@section('content')
    <div class="content_group">
        <div class="group_articles">
            @foreach($articlesGenre as $article)
                @include('layouts.short_article')
            @endforeach
        </div>
    </div>
@endsection
