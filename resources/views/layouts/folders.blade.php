@extends('layouts.main')
@section('title', $title . 'Избранное')
@section('main')
    <main class="main">
        <article class="favorite">
            <section class="favorite_nav">
                <div class="favorite_nav_container">
                    <div class="favorite_container_item">
                        <div class="favorite_item">
                            <a href="{{ route('account.folders.index') }}" class="folder_button @if(request()->is('account/folders')) folder_button_active @endif">
                                <div class="folder_img"></div>
                                <div class="folder_title">
                                    Все - {{ \App\Models\Favorites::query()->where('user_id', auth()->id())->count() }}
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

                    @if(request()->routeIs('account.folders.index'))
                        <form class="favorite_filter">
                            <div class="favorite_filter_item">
                                <div class="favorite_filter_label">Тип</div>
                                <div class="favorite_filter_input">
                                    <div class="check_select">
                                        @foreach($types as $type)
                                            <label><input type="checkbox" name="type[]" value="{{$type->id}}"
                                                @if(request()->exists('type'))
                                                    @foreach(request('type') as $typeValue)
                                                        @checked($type->id === (int) $typeValue)
                                                        @endforeach
                                                    @endif
                                                >{{$type->title}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="favorite_filter_item">
                                <div class="favorite_filter_label">Категория</div>
                                <div class="favorite_filter_input">
                                    <div class="check_select">
                                        @foreach($categories as $category)
                                            <label><input type="checkbox" name="category[]" value="{{$category->id}}"
                                                @if(request()->exists('category'))
                                                    @foreach(request('category') as $categoryValue)
                                                        @checked($category->id === (int) $categoryValue)
                                                        @endforeach
                                                    @endif
                                                >{{$category->title}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="favorite_filter_item">
                                <div class="favorite_filter_label">Жанр</div>
                                <div class="favorite_filter_input">
                                    <div class="check_select">
                                        @foreach($genres as $genre)
                                            <label><input type="checkbox" name="genre[]" value="{{$genre->id}}"
                                                @if(request()->exists('genre'))
                                                    @foreach(request('genre') as $genreValue)
                                                        @checked($genre->id === (int) $genreValue)
                                                        @endforeach
                                                    @endif
                                                >{{$genre->title}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="favorite_filter_item">
                                <div class="favorite_filter_label">Строгий поиск по жанру?</div>
                                <div class="favorite_filter_input">
                                    <label class="toggle-wrapper">
                                        <input type="checkbox" id="genre_and_or" name="genre_and_or" @checked(request('genre_and_or') !== null) />
                                        <div class="toggle-slider">
                                            <div class="toggle-knob"></div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="group-btn">
                                <a href="#" onClick="window.location.replace(location.pathname);">
                                    <button type="button" class="btn-delete">СБРОСИТЬ</button>
                                </a>
                                <button type="submit" class="btn-search">ПОИСК</button>
                            </div>
                        </form>
                    @endif
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

        (function ($) {
            function setChecked(target) {
                let checked = $(target).find("input[type='checkbox']:checked").length;
                if (checked) {
                    $(target).find('select option:first').html('Выбрано: ' + checked);
                } else {
                    $(target).find('select option:first').html('Выберите из списка');
                }
            }

            $.fn.check_select = function () {
                this.wrapInner('<div class="check_select-popup"></div>');
                this.prepend(
                    '<div class="check_select-control">' +
                    '<select class="form-control"><option></option></select>' +
                    '<div class="check_select-over"></div>' +
                    '</div>'
                );

                this.each(function () {
                    setChecked(this);
                });
                this.find('input[type="checkbox"]').click(function () {
                    setChecked($(this).parents('.check_select'));
                });

                this.parent().find('.check_select-control').on('click', function () {
                    $popup = $(this).next();
                    $('.check_select-popup').not($popup).css('display', 'none');
                    if ($popup.is(':hidden')) {
                        $popup.css('display', 'block');
                        $(this).find('select').focus();
                    } else {
                        $popup.css('display', 'none');
                    }
                });

                $('html, body').on('click', function (e) {
                    if ($(e.target).closest('.check_select').length == 0) {
                        $('.check_select-popup').css('display', 'none');
                    }
                });
            };
        })(jQuery);

        $('.check_select').check_select();
    </script>
@endsection
