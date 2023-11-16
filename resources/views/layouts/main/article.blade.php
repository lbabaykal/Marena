@extends('layouts.main')
@section('title', $title . $article->title_rus . '🔥︎')
@section('main')
    <main class="main">
        <section class="content_article">
            <div class="article_full">
                <div class="article_image">
                    <img src="{{ $article->image ? asset('articles/' . $article->image) : asset('storage/no_image.png') }}" alt="">
                    <div class="my_list_cont">
                        <select class="my_list @if($favorite->isNotEmpty()) favourite_active @endif" id="folder">
                            @if($favorite->isEmpty())
                                <option value="">Добавить в список</option>
                            @endif
                            @foreach($folders as $folder)
                                <option data-folder="{{ $folder->id }}" data-article="{{ $article->id }}"
                                        {{ $folder->id === $favorite->value('folder_id') ? ' selected': '' }}>{{ $folder->title }}</option>
                            @endforeach
                        </select>
                        @if($favorite->isNotEmpty())
                            <div class="favourite">
                                <button onclick="favorite_del({{ $article->id }})" id="favourite" class="favourite_button"></button>
                            </div>
                        @endif
                    </div>
                    @if($article->is_rating == 1)
                        @include('layouts.rating')
                    @endif
                </div>

                <div class="article_info">
                    <div class="info_key">Russia:</div>
                    <div class="info_value">{{ $article->title_rus }}</div>
                    <div class="info_key">Original:</div>
                    <div class="info_value">{{ $article->title_orig }}</div>
                    <div class="info_key">English:</div>
                    <div class="info_value">{{ $article->title_eng }}</div>
                    <div class="info_key">Категория:</div>
                    <div class="info_value">
                        <a href="{{ route('article.filter_article', ['category[]' => $article->category->id]) }}">
                            {{ $article->category->title }}
                        </a>
                    </div>
                    <div class="info_key">Тип:</div>
                    <div class="info_value">{{ $article->type->title }}</div>
                    <div class="info_key">Жанр:</div>
                    <div class="info_value">
                        @foreach($article->genres as $genre)
                            <a href="{{ route('article.filter_article', ['genre[]' => $genre->id, 'category[]' => $article->category->id]) }}">
                                {{ $genre->title }}
                            </a>
                        @endforeach
                    </div>
                    @isset($article->episodes)
                        <div class="info_key">Эпизоды:</div>
                        <div class="info_value">{{ $article->episodes }}</div>
                    @endisset
                    <div class="info_key">Выпуск:</div>
                    <div class="info_value">{{ \Carbon\Carbon::parse($article->release)->format('d.m.Y') }}</div>
                    <div class="info_key">Страна:</div>
                    <div class="info_value">{{ $article->country->title }}</div>
                    <div class="info_key">Студия:</div>
                    <div class="info_value">{{ $article->studio->title }}</div>
                    @isset($article->age_limit)
                        <div class="info_key">Возрастной рейтинг:</div>
                        <div class="info_value">{{ $article->age_limit }}</div>
                    @endisset
                    <div class="info_key">Описание:</div>
                    <div class="description_value">{{ $article->description }}</div>
                </div>
            </div>

            @if($article->is_comment == 1)
                <div class="comments_cont">
                    <div class="comments_title">КОММЕНТАРИЕВ ({{ $article->comments_count }}):</div>
                    @include('layouts.comment')
                </div>
                @include('layouts.add_comment')
                <div class="modal_comment"></div>
            @endif
        </section>
    </main>
    <script src="{{ asset('js/Full_Article.js') }}"></script>
@endsection
