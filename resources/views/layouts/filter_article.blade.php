@extends('layouts.main')
@section('title', $title . 'Поиск...')
@section('main')
<main class="main">
    <div class="filter">
        <form action="{{route('article.filter_article')}}" method="GET" enctype="multipart/form-data">

            <label for="title">
                <input id="title" type="text" name="title" placeholder="Название..." value="{{request('title')}}"/>
            </label>

            Тип:
            <div class="checkselect">
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

            Категория:
            <div class="checkselect">
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

            <label for="genre_and_or">Строгий поиск по жанру?
                <input type="checkbox" id="genre_and_or" name="genre_and_or" @checked(request('genre_and_or') !== null) />
            </label>

            Жанр:
            <div class="checkselect">
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

            <label>Страна:
                <select class="country" name="country">
                    <option value="">Любая</option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}"
                        @if(request()->exists('country'))
                            @selected($country->id === (int) request('country'))
                        @endif
                        >{{$country->title}}</option>
                    @endforeach
                </select>
            </label>

            <label for="year_from">
                <input id="year_from" type="number" name="year_from" placeholder="Год от..." value="{{request('year_from')}}"/>
            </label>

            <label for="year_to">
                <input id="year_to" type="number" name="year_to" placeholder="Год до.." value="{{request('year_to')}}"/>
            </label>

            <button type="submit">Поиск</button>
        </form>
    </div>

    <div class="articles_main_short">
        <div class="articles_group_short">
            @foreach($articles as $article)
                @include('layouts.short_article')
            @endforeach
        </div>
    </div>
</main>
    {{$articles->withQueryString()->links()}}


<style>
    .checkselect {
        position: relative;
        display: inline-block;
        min-width: 200px;
        text-align: left;
    }
    .checkselect-control {
        position: relative;
        padding: 0 !important;
    }
    .checkselect-control select {
        position: relative;
        display: inline-block;
        width: 100%;
        margin: 0;
        padding-left: 5px;
        height: 30px;
    }
    .checkselect-over {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        cursor: pointer;
    }
    .checkselect-popup {
        display: none;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        width: 100%;
        height: auto;
        max-height: 200px;
        position: absolute;
        top: 100%;
        left: 0px;
        border: 1px solid #dadada;
        border-top: none;
        background: #fff;
        color: #000;
        z-index: 9999;
        overflow: auto;
        user-select: none;
    }
    .checkselect label {
        position: relative;
        display: block;
        margin: 0;
        padding: 4px 6px 4px 25px;
        font-weight: normal;
        font-size: 1em;
        line-height: 1.1;
        cursor: pointer;
    }
    .checkselect-popup input {
        position: absolute;
        top: 5px;
        left: 8px;
        margin: 0 !important;
        padding: 0;
    }
    .checkselect-popup label:hover {
        background: #03a2ff;
        color: #000;
    }
    .checkselect-popup fieldset {
        display: block;
        margin:  0;
        padding: 0;
        border: none;
    }
    .checkselect-popup fieldset input {
        left: 15px;
    }
    .checkselect-popup fieldset label {
        padding-left: 32px;
    }
    .checkselect-popup legend {
        display: block;
        margin: 0;
        padding: 5px 8px;
        font-weight: 700;
        font-size: 1em;
        line-height: 1.1;
    }
</style>
<script>
    (function($) {
        function setChecked(target) {
            var checked = $(target).find("input[type='checkbox']:checked").length;
            if (checked) {
                $(target).find('select option:first').html('Выбрано: ' + checked);
            } else {
                $(target).find('select option:first').html('Выберите из списка');
            }
        }

        $.fn.checkselect = function() {
            this.wrapInner('<div class="checkselect-popup"></div>');
            this.prepend(
                '<div class="checkselect-control">' +
                '<select class="form-control"><option></option></select>' +
                '<div class="checkselect-over"></div>' +
                '</div>'
            );

            this.each(function(){
                setChecked(this);
            });
            this.find('input[type="checkbox"]').click(function(){
                setChecked($(this).parents('.checkselect'));
            });

            this.parent().find('.checkselect-control').on('click', function(){
                $popup = $(this).next();
                $('.checkselect-popup').not($popup).css('display', 'none');
                if ($popup.is(':hidden')) {
                    $popup.css('display', 'block');
                    $(this).find('select').focus();
                } else {
                    $popup.css('display', 'none');
                }
            });

            $('html, body').on('click', function(e){
                if ($(e.target).closest('.checkselect').length == 0){
                    $('.checkselect-popup').css('display', 'none');
                }
            });
        };
    })(jQuery);

    $('.checkselect').checkselect();
</script>
@endsection
