@extends('layouts.folders')
@section('folders')
    @foreach($articles as $article)
        @include('layouts.article_card_folders')
    @endforeach
@endsection
