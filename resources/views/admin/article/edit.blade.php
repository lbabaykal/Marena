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
                <select class="studio_id" name="studio_id[]" multiple>
                    @foreach($studios as $studio)
                        <option value="{{ $studio->id }}"
                        @foreach($article->studio_id as $articleStudio)
                            @selected($studio->id === $articleStudio->id)
                            @endforeach
                        >{{ $studio->title }}</option>
                    @endforeach
                </select>
            </label>

            <label for="episodes_released">Эпизодов вышло: @error('episodes_released') {{ $message }} @enderror
                <input id="episodes_released" type="number" name="episodes_released" value="{{ $article->episodes_released }}" />
            </label>

            <label for="episodes_total">Эпизодов всего: @error('episodes_total') {{ $message }} @enderror
                <input id="episodes_total" type="number" name="episodes_total" value="{{ $article->episodes_total }}" />
            </label>

            <label for="duration">Продолжительность (минуты): @error('duration') {{ $message }} @enderror
                <input id="duration" type="number" name="duration" value="{{ $article->duration }}" />
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

            <label>Возрастное ограничение: @error('age_limit') {{ $message }} @enderror
                <select name="age_limit">
                    @foreach($age_limits as $age_limit)
                        <option value="{{ $age_limit }}"  @selected($article->age_limit === $age_limit)>{{ $age_limit }}</option>
                    @endforeach
                </select>
            </label>

            <label>Статус: @error('status') {{ $message }} @enderror
                <select name="status">
                    <option value="">Нету</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}"  @selected($article->status === $status)>{{ $status }}</option>
                    @endforeach
                </select>
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
