@extends('layouts.main_without_footer')
@section('title', $title . 'Поиск...')
@section('main')
    <main class="main">
        @include('layouts.filter')

        <div class="articles_main_short">
            <div class="articles_group_short">
                @foreach($articles as $article)
                    @include('layouts.article_card')
                @endforeach
            </div>
        </div>
    </main>

    {{$articles->withQueryString()->links()}}

    <link rel="stylesheet" href="{{ asset('css/filter.css') }}">
    <script>
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
