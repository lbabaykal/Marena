@extends('layouts.main')
@section('title', config('app.name') . $article->title_rus . '🔥︎')
@section('content')
    <section class="content_article">
        <div class="article_full">
            <div class="article_image">
                <img src="{{asset('images_articles/' . $article->image)}}" alt="">
                <div class="my_list_cont">
                    <div class="my_list">
                        <button class="my_list_button">Добавить в список <sup style="font-size: 12px">test</sup></button>
                    </div>
                    <div class="favourite">
                        <button onclick="favorite({{$article->id}})" id="favourite" class="favourite_button @if($article->favorite) favourite_active @endif "></button>
                    </div>
                </div>
                @if($article->is_rating == 1)
                    @include('layouts.rating')
                @endif
             </div>

            <div class="article_info">
                <div class="info_key">Russia:</div>
                <div class="info_value">{{$article->title_rus}}</div>
                <div class="info_key">Original:</div>
                <div class="info_value">{{$article->title_orig}}</div>
                <div class="info_key">English:</div>
                <div class="info_value">{{$article->title_eng}}</div>
                <div class="info_key">Категория:</div>
                <div class="info_value">{{$article->category->title}}</div>
                <div class="info_key">Тип:</div>
                <div class="info_value">{{$article->type->title}}</div>
                <div class="info_key">Жанр:</div>
                <div class="info_value">
                @foreach($article->genre_id as $genre)
                    <a href="{{route('genre.show', $genre->id)}}">{{$genre->title}}</a>
                @endforeach
                </div>
                @isset($article->episodes)
                    <div class="info_key">Эпизоды:</div>
                    <div class="info_value">{{$article->episodes}}</div>
                @endisset
                <div class="info_key">Год:</div>
                <div class="info_value">{{$article->year}}</div>
                <div class="info_key">Страна:</div>
                <div class="info_value">{{$article->country->title}}</div>
                @isset($article->age_limit)
                    <div class="info_key">Возрастной рейтинг:</div>
                    <div class="info_value">{{$article->age_limit}}</div>
                @endisset
                <div class="info_key">Описание:</div>
                <div class="description_value">{{$article->description}}</div>
            </div>
        </div>

        @if($article->is_comment == 1)
            <div class="comments_cont">
                <div class="comments_title">КОММЕНТАРИИ:</div>
                @include('layouts.comment')
            </div>
            @include('layouts.add_comment')
            <div class="modal_comment"></div>
        @endif
    </section>
    <script src="{{asset('js/Full_Article.js')}}"></script>
@endsection
