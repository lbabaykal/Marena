@extends('layouts.main')
@section('title', $title . 'Аккаунт ' . Auth::user()->username)
@section('main')
    <main class="main">
        <section class="content_My_Profile">
            <div class="My_Profile_User">
                <div class="user_left">
                    <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="">
                    <div class="user_group_name">{{ Auth::user()->rolesRus->first() }}</div>
                </div>
                <div class="user_right">
                    <table id="My_Profile" class="My_Profile_User_table">
                        <caption>Аккаунт {{ Auth::user()->username }} - ID: {{ Auth::user()->id }}</caption>
                        <tbody>
                        <tr>
                            <td>Имя</td>
                            <td>{{ Auth::user()->username }}</td>
                        </tr>
                        <tr>
                            <td>Подписка</td>
                            <td>{SUBSCRIPTION}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Номер телефона</td>
                            <td>{PHONE}</td>
                        </tr>
                        <tr>
                            <td>День рождения</td>
                            <td>{BIRTHDAY}</td>
                        </tr>
                        <tr>
                            <td>Дата регистрации</td>
                            <td>{{ Auth::user()->created_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
