@extends('layouts.main')
@section('title', $title . 'Создание папки')
@section('main')
    <main class="main">
        <section class="content_My_Profile">
            <div class="My_Profile">
                <form action="{{ route('account.folders.store') }}" method="POST">
                    @csrf
                    <label for="title">Название</label> @error('title') {{ $message }} @enderror
                    <input id="title" name="title" type="text" value="{{ old('title') }}" />

                    <label for="isPublic">Сделать общедоступным?</label> @error('isPublic') {{ $message }} @enderror
                    <input id="isPublic" name="isPublic" type="checkbox" @checked(old('isPublic')) />
                    <button type="submit">Создать</button>
                </form>
            </div>
        </section>
    </main>
@endsection
