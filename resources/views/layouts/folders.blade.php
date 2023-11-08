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
                                Все - {{ \App\Models\Favorites::query()->where('user_id', \Illuminate\Support\Facades\Auth::id())->count() }}
                            </div>
                        </a>
                        @can('create', \App\Models\Folder::class)
                            <a onclick="ShowCreateFolderWindow()">
                                <div class="folder_add"></div>
                            </a>
                        @endcan
                    </div>

                    @foreach($folders as $folder)
                        <div class="favorite_item">
                            <a href="{{ route('account.folders.show', $folder->id) }}" class="folder_button @if(request()->is('account/folders/' . $folder->id)) folder_button_active @endif">
                                <div class="folder_img"></div>
                                <div class="folder_title">
                                    {{ $folder->title }} - {{ $folder->articles_count }}
                                </div>
                            </a>
                            @can('delete', $folder)
                                <a onclick="ShowEditeFolderWindow({{ $folder->id }})">
                                    <div class="folder_edit"></div>
                                </a>
                            @endcan
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="favorite_main">
                @yield('folders')
            </section>
        </article>
    </main>
    {{$articles->withQueryString()->links()}}

    <div class="modal_window"></div>

    <script>
        const Modal = document.querySelector('.modal_window');

        function ShowCreateFolderWindow() {
            $(".modal_window").load("{{ route('account.folders.create') }}");
            Modal.classList.toggle("show-modal");
        }

        function ShowEditeFolderWindow(id) {
            $(".modal_window").load("{{ route('account.folders.index') }}/" + id + "/edit");
            Modal.classList.toggle("show-modal");
        }

        function HideModalWindow () {
            Modal.classList.toggle("show-modal");
        }
    </script>
@endsection
