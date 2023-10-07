@extends('layouts.main')
@section('content')
    <div class="content_group">
        <div class="group_articles">
            @foreach($articlesCategory as $article)
                @include('layouts.short_article')
            @endforeach

        </div>
    </div>
    {{$articlesCategory->links()}}
@endsection
