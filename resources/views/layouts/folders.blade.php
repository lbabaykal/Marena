@extends('layouts.main')
@section('title', $title . 'Избранное')
@section('main')
    <main class="main">
        <article class="favorite">
            <section class="favorite_nav">
                <div class="favorite_container">
                    <div class="favorite_item">
                        <a href="{{ route('account.folders.index') }}" class="folder_button @if(request()->is('account/folders')) folder_button_active @endif">
                            <div class="folder_img"></div>
                            <div class="folder_title">
                                Общее в папках  - {{ \App\Models\Favorites::query()->where('user_id', \Illuminate\Support\Facades\Auth::id())->count() }}
                            </div>
                        </a>
                        @can('create', \App\Models\Folder::class)
                            <a href="{{ route('account.folders.create') }}">
                                <div class="folder_add"></div>
                            </a>
                        @endcan
                    </div>

                    @foreach($folders as $folder)
                        <div class="favorite_item">
                            <a href="{{ route('account.folders.show', $folder->id) }}" class="folder_button @if(request()->is('account/folders/' . $folder->id)) folder_button_active @endif">
                                <div class="folder_img"></div>
                                <div class="folder_title">
                                    {{ $folder->title }} - {{ \App\Models\Favorites::query()->where('folder_id', $folder->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->count() }}
                                </div>
                            </a>
                            @can('delete', $folder)
                                <a href="{{ route('account.folders.edit', $folder->id) }}">
                                    <div class="folder_edit"></div>
                                </a>
                            @endcan
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="favorite_main">

                @if(session('success'))
                    <div>Success: {{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div>Error: {{ session('error') }}</div>
                @endif

                @yield('folders')
            </section>
        </article>
    </main>
    {{$articles->withQueryString()->links()}}
@endsection
