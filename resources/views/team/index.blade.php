@extends('layouts.main')
@section('title', $title . 'Команды')
@section('main')
    <main class="main">
        <div class="static_page_cont" style="background: #fff">
            <div class="static_page_head">
                <div class="static_page_title">Команды</div>
                <div class="static_page_add_new">
                    <a href="{{ route('teams.create') }}">Создать</a>
                </div>
            </div>
            <div class="static_page_content">
                <table id="Books" class="flat-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>logo</th>
                        <th>Название</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td class="ct">{{ $team->id }}</td>
                            <td class="ct">
                                <img src="{{ $team->logo ? Storage::disk('teams')->url($team->logo) : asset('images/no_logo.png') }}" width="60px" height="60px">
                            </td>
                            <td class="fix_width">
                                <a href="{{ route('teams.show', $team->id) }}">
                                    {{ $team->title }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{ $teams->links() }}
@endsection
