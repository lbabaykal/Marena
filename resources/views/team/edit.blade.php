@extends('layouts.main')
@section('title', $title . 'Команды')
@section('main')

    <main class="main">
        <div class="static_page_cont" style="background: #fff">
            <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('Patch')
                <label for="title">Название: @error('title') {{ $message }} @enderror
                    <input id="title" type="text" name="title" value="{{ old('title') ?? $team->title }}"/>
                </label>

                <label>Логотип: @error('logo') {{ $message }} @enderror
                    <input name="logo" id="logo" type="file" accept="image/png, image/jpeg" />
                </label>

                <label for="description">Описание:</label> @error('description') {{ $message }} @enderror
                <textarea id="description" name="description" rows="6" cols="10">{{ old('description') ?? $team->description }}</textarea>

                <div class="window_buttons">
                    <button class="window_button button_save" type="submit">Редактировать</button>
                    <a href="{{ route('teams.show', $team->id) }}">
                        <button class="window_button button_close" type="button">Отмена</button>
                    </a>
                </div>
            </form>
        </div>
    </main>

@endsection
