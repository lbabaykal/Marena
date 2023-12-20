@extends('layouts.main')
@section('title', $title . $article->title_rus . '🔥︎')
@section('main')
    <main class="main">
        <section class="content_article">
            <div class="article_full">
                <div class="article_image">
                    <img src="{{ $article->image ? Storage::disk('articles')->url($article->image) : asset('images/no_image.png') }}" alt="">
                    <div class="my_list_cont">
                        <select class="my_list @if($userFavorite->isNotEmpty()) favourite_active @endif" id="folder">
                            @if($userFavorite->isEmpty())
                                <option value="">Добавить в список</option>
                            @endif
                            @foreach($userFolders as $folder)
                                <option data-folder="{{ $folder->id }}" data-article="{{ $article->id }}"
                                        {{ $folder->id === $userFavorite->value('folder_id') ? ' selected': '' }}>{{ $folder->title }}</option>
                            @endforeach
                        </select>
                        @if($userFavorite->isNotEmpty())
                            <div class="favourite">
                                <button onclick="favorite_del({{ $article->id }})" id="favourite" class="favourite_button"></button>
                            </div>
                        @endif
                        @isset($userRating)
                            <div class="favourite">
                                <button onclick="rating_del({{ $article->id }})" id="rating" class="favourite_button"></button>
                            </div>
                        @endif
                    </div>
                    @if($article->is_rating == 1)
                        @include('layouts.rating')
                    @endif
                </div>

                <div class="article_info">
                    <div class="article_info_titles">
                        <div style="font-weight: 700;">{{ $article->title_rus }}</div>
                        <div style="font-size: 18px;">{{ $article->title_eng }}</div>
                        <div style="font-size: 18px;">{{ $article->title_orig }}</div>
                    </div>
                    <div class="article_info_container">
                        <div class="article_info_block_left">
                            <div class="article_info_line">
                                <div class="info_key">Тип:</div>
                                <div class="info_value">
                                    {{ $article->type->title }} - <div class="info_value_age_limit">{{ $article->age_limit }}</div>
                                </div>
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

                            <div class="article_info_line">
                                    <div class="info_key">Эпизоды:</div>
                                    <div class="info_value">{{ $article->episodes_released . '/' . $article->episodes_total . ' ~ ' . $article->duration }}</div>
                            </div>
                        </div>

                        <div class="article_info_block_right">
                            <div class="article_info_line">
                                <div class="info_key">Выпуск:</div>
                                <div class="info_value">{{ $article->release }}</div>
                            </div>
                            <div class="article_info_line">
                                <div class="info_key">Страна:</div>
                                <div class="info_value">{{ $article->country->title }}</div>
                            </div>
                            <div class="article_info_line">
                                <div class="info_key">Студия:</div>
                                <div class="info_value">
                                    @foreach($article->studios as $studio)
                                        <a href="{{ route('article.filter_article', ['studio[]' => $studio->id]) }}">
                                            {{ $studio->title }}
                                        </a>
                                    @endforeach
                                </div>
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

                            <a href="#" class="team">
                                <div class="team_img">
                                    <img src="{{ asset('teams/anidub.png') }}">

                                </div>
                                <div class="team_block">
                                    <div class="team_name">AniLibria</div>
                                    <div class="team_voiced_episodes">Озвучено: 1/12</div>
                                </div>
                            </a>

                            <a href="#" class="team">
                                <div class="team_img">
                                    <img src="{{ asset('teams/anilibria.jpg') }}">
                                </div>
                                <div class="team_block">
                                    <div class="team_name">AniDub</div>
                                    <div class="team_voiced_episodes">Озвучено: 6/12</div>
                                </div>
                            </a>

                            <a href="#" class="team">
                                <div class="team_img">
                                    <img src="{{ asset('teams/shiza_project.jpg') }}">
                                </div>
                                <div class="team_block">
                                    <div class="team_name">SHIZA Project</div>
                                    <div class="team_voiced_episodes">Субтитры: 8/12</div>
                                </div>
                            </a>

                            <a href="#" class="team">
                                <div class="team_img">
                                    <img src="{{ asset('teams/amazing_dubbing.jpg') }}">
                                </div>
                                <div class="team_block">
                                    <div class="team_name">Amazing Dubbing</div>
                                    <div class="team_voiced_episodes">Озвучено: 5/12</div>
                                </div>
                            </a>

                            <a href="#" class="team">
                                <div class="team_img">
                                    <img src="{{ asset('teams/sovet_romantica.jpg') }}">
                                </div>
                                <div class="team_block">
                                    <div class="team_name">Sovet Romantica</div>
                                    <div class="team_voiced_episodes">Субтитры: 5/12</div>
                                </div>
                            </a>

                            <a href="#" class="team">
                                <div class="team_img">
                                    <img src="{{ asset('teams/dream_cast.jpg') }}">
                                </div>
                                <div class="team_block">
                                    <div class="team_name">Dream Cast</div>
                                    <div class="team_voiced_episodes">Озвучено: 3/12</div>
                                </div>
                            </a>

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
