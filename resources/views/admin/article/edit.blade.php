@extends('layouts.admin')
@section('content')
<div class="modal_window_content">
    <div class="window_heading">
        <div class="window_title">Редактирование статьи</div>
        <div class="window_close">❌</div>
    </div>
    <div class="window_content">
        <form id="book_add" action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('Patch')
            <label for="title_rus">Russian: @error('title_rus') {{ $message }} @enderror
                <input id="title_rus" type="text" name="title_rus" value="{{ old('title_rus') ?? $article->title_rus }}"/>
            </label>

            <label for="title_orig">Original: @error('title_orig') {{ $message }} @enderror
                <input id="title_orig" type="text" name="title_orig" value="{{ old('title_orig') ?? $article->title_orig }}"/>
            </label>

            <label for="title_eng">English: @error('title_eng') {{ $message }} @enderror
                <input id="title_eng" type="text" name="title_eng" value="{{ old('title_eng') ?? $article->title_eng }}"/>
            </label>

            <label>Категория: @error('category_id') {{ $message }} @enderror
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id === $article->category_id) >{{ $category->title }}</option>
                    @endforeach
                </select>
            </label>

            <label>Тип: @error('type_id') {{ $message }} @enderror
                <select name="type_id">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @selected($type->id === $article->type_id) >{{ $type->title }}</option>
                    @endforeach
                </select>
            </label>

            <label>Студия: @error('studio_id') {{ $message }} @enderror
                <select name="studio_id">
                    @foreach($studios as $studio)
                        <option value="{{ $studio->id }}" @selected($studio->id === $article->studio_id) >{{ $studio->title }}</option>
                    @endforeach
                </select>
            </label>

            <label for="episodes">Эпизоды: @error('episodes') {{ $message }} @enderror
                <input id="episodes" type="text" name="episodes" value="{{ $article->episodes }}" placeholder="?/?"/>
            </label>

            <label for="release">Год: @error('release') {{ $message }} @enderror
                <input id="release" type="date" name="release" value="{{ $article->release }}"/>
            </label>

            <label>Страна: @error('country_id') {{ $message }} @enderror
                <select name="country_id">
                    @foreach($countries as $county)
                        <option value="{{ $county->id }}"  @selected($county->id === $article->country_id)>{{ $county->title }}</option>
                    @endforeach
                </select>
            </label>

            <label for="age_limit">Возрастное ограничение: @error('age_limit') {{ $message }} @enderror
                <input id="age_limit" type="text" name="age_limit" value="{{ $article->age_limit }}"/>
            </label>

            <label for="is_show">Разрешить показ? @error('is_show') {{ $message }} @enderror
                <input type="checkbox" id="is_show" name="is_show" @checked($article->is_show === 1) />
            </label>

            <label for="is_comment">Разрешить комментарии? @error('is_comment') {{ $message }} @enderror
                <input type="checkbox" id="is_comment" name="is_comment" @checked($article->is_comment === 1) />
            </label>

            <label for="is_rating">Разрешить рейтинг? @error('is_rating') {{ $message }} @enderror
                <input type="checkbox" id="is_rating" name="is_rating" @checked($article->is_rating === 1) />
            </label>

            <label>Жанр: @error('genre_id') {{ $message }} @enderror
                <select class="genre_id" name="genre_id[]" multiple>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}"
                                @foreach($article->genre_id as $articleGenre)
                                    @selected($genre->id === $articleGenre->id)
                                @endforeach
                        >{{ $genre->title }}</option>
                    @endforeach
                </select>
            </label>

            <label>Изображение: @error('image') {{ $message }} @enderror
                <input name="image" id="image" type="file" accept="image/png, image/jpeg" value="{{ $article->image }}"/>
            </label>

            <label for="description">Описание:</label> @error('description') {{ $message }} @enderror
            <textarea id="description" name="description" rows="6" cols="10">{{ old('description') ?? $article->description }}</textarea>

            <div class="window_buttons">
                <button class="window_button button_save" type="submit">Редактировать</button>
                <a href="{{ route('admin.articles.index') }}">
                    <button class="window_button button_close" type="button">Отмена</button>
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
