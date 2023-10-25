@extends('layouts.main')
@section('title', $title . 'Папка   ' . $folder->title)
@section('main')
<main class="main">
    <section class="content_My_Profile">
        <div class="My_Profile">
            <div class="title_page">{{$folder->title}}</div>
            <div class="content_page">
                <table id="My_Favorites" class="My_Profile_table green_table">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($folder->articles as $article)
                            <tr>
                                <td class="left_table"><a href="{{route('article.show', $article->article_id)}}">{{$article->articles[0]->title_rus}}</a></td>
                                <td class="left_table">{{$article->articles[0]->category->title}}</td>
                                <td class="center_table">{{$article->articles[0]->rating->rating}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
@endsection
