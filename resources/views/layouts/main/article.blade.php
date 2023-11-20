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
                    <div class="article_info_titles">
                        <div>{{ $article->title_rus }}</div>
                        <div>{{ $article->title_eng }}</div>
                        <div>{{ $article->title_orig }}</div>
                    </div>
                    <div class="article_info_container">
                        <div class="article_info_block_left">
                            <div class="article_info_line">
                                <div class="info_key">Тип:</div>
                                <div class="info_value">
                                    {{ $article->type->title }} - <div class="info_value_age_limit">{{ $article->age_limit->title }}</div>
                                </div>
                            </div>
                            <div class="article_info_line">
                                @isset($article->episodes)
                                    <div class="info_key">Эпизоды:</div>
                                    <div class="info_value">{{ $article->episodes }}</div>
                                @endisset
                            </div>
                            <div class="article_info_line">
                                <div class="info_key">Жанр:</div>
                                <div class="info_value">
                                    @foreach($article->genres as $genre)
                                        <a href="{{ route('article.filter_article', ['genre[]' => $genre->id, 'category[]' => $article->category->id]) }}">
                                            {{ $genre->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="article_info_block_right">
                            <div class="article_info_line">
                                <div class="info_key">Выпуск:</div>
                                <div class="info_value">{{ \Carbon\Carbon::parse($article->release)->format('d.m.Y') }}</div>
                            </div>
                            <div class="article_info_line">
                                <div class="info_key">Страна:</div>
                                <div class="info_value">{{ $article->country->title }}</div>
                            </div>
                            <div class="article_info_line">
                                <div class="info_key">Студия:</div>
                                <div class="info_value">{{ $article->studio->title }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="article_info_description">
                        <span>Описание:</span>
                        {{ $article->description }}
                    </div>

                    <div class="article_info_teams">
                        <div>Озвучено коммандами</div>
                        <div class="teams_container">

                            <div class="team">
                                <div class="team_img">
                                    <img src="{{ asset('storage/no_image.png') }}">

                                </div>
                                <div class="team_block">
                                    <div class="team_name">AniLibria</div>
                                    <div class="team_voiced_episodes">1/12</div>
                                </div>
                            </div>

                            <div class="team">
                                <div class="team_img">
                                    <img src="{{ asset('storage/no_image.png') }}">
                                </div>
                                <div class="team_block">
                                    <div class="team_name">AniLibria</div>
                                    <div class="team_voiced_episodes">1/12</div>
                                </div>
                            </div>

                        </div>
                    </div>
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
