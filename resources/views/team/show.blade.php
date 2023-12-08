@extends('layouts.main')
@section('title', $title . 'Команды')
@section('main')
    <main class="main">
        <div class="static_page_cont" style="background: #fff">

            {{ $team->id }} <br>
            <img src="{{ $team->logo ? Storage::disk('teams')->url($team->logo) : asset('images/no_logo.png') }}"><br>
            {{ $team->title }} <br>
            {{ $team->description }} <br>

            <a href="{{ route('teams.edit', $team->id) }}">
                Редактировать
            </a>

        </div>
    </main>
@endsection
