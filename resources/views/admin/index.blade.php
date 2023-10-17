@extends('layouts.admin')
@section('title', $title . 'Админ панель')
@section('content')
    <div class="dashboard">
        <div class="section section_red">
            <div class="section_icon"><img src="images_icon/user.png"></div>
            <div class="section_text">Пользователей<br><span>{{\App\Models\User::count()}}</span></div>
        </div>
        <div class="section section_orange">
            <div class="section_icon"><img src="images_icon/book.png"></div>
            <div class="section_text">Статей<br><span>{{\App\Models\Article::count()}}</span></div>
        </div>
        <div class="section section_green">
            <div class="section_icon"><img src="images_icon/comment.png"></div>
            <div class="section_text">Комментариев<br><span>{{\App\Models\Comments::count()}}</span></div>
        </div>
        <div class="section section_violet">
            <div class="section_icon"><img src="images_icon/visitors.png"></div>
            <div class="section_text">Посетителей<br><span>{COUNT_VISITORS}</span></div>
        </div>
    </div>
@endsection
