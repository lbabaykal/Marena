@extends('layouts.main')
@section('title', $title . 'Избранное ' . Auth::user()->username)
@section('main')
<main class="main">
    <section class="content_My_Profile">
        <div class="My_Profile">
            @foreach($folders as $folder)
                <div class="title_page">
                    <a href="{{route('account.favorites.folders.show', $folder->id)}}">{{$folder->title}}
                    </a>
                </div>
            @endforeach
            <div>================<br>
                ПОТОМ ВЫВЕСТИ ТУТ ВСЕ ЧТО ИЗБРАННО С ПАГИНАЦИЕЙ И ФИЛЬТРОМ<br>
                ================
            </div>
        </div>
    </section>
</main>
@endsection
