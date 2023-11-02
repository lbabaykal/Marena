@extends('layouts.main')
@section('title', $title . 'Редактирование папки')
@section('main')
    <main class="main">
        <section class="content_My_Profile">
            <div class="My_Profile">
                <form action="{{ route('account.folders.update', $folder->id) }}" method="POST" >
                    @csrf
                    @method('PATCH')

                    <label for="title">Название</label> @error('title') {{ $message }} @enderror
                    <input id="title" name="title" type="text" value="{{ $folder->title }}" />

                    <label for="isPublic">Сделать общедоступным?</label> @error('isPublic') {{ $message }} @enderror
                    <input id="isPublic" name="isPublic" type="checkbox" @checked( $folder->isPublic ) />
                    <button type="submit">Изменить</button>
                </form>

                <br>

                <form action="{{ route('account.folders.destroy', $folder->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Удалить папку</button>
                </form>
            </div>
        </section>
    </main>
@endsection
