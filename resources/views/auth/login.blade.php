<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title', $title . ' Авторизация')</title>
    <meta charset="UTF-8">
    <meta name="description" content="{DESCRIPTION}" />
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('public/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="modal_window_content">
        <div class="authorization_left">
            <div class="authorization_container">
                <span>Авторизация</span>
                <form action="{{ route('login') }}" method="POST" id="authorization" autocomplete="off">
                    @csrf
                    @error('email') <div class="warning">{{ $message }}</div> @enderror
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" required />
                    @error('password') <div class="warning">{{ $message }}</div> @enderror
                    <input type="password" name="password" placeholder="Password" autocomplete="off" required />
                    <a href="{{ route('password.request') }}" class="text_a">Забыли пароль?</a>
                    <button type="submit" class="button button_auth">Авторизоваться</button>
                </form>
            </div>
        </div>
        <div class="authorization_right">
            <a href="/" class="window_close"></a>
            <div class="authorization_container">
                <div class="logo">MOON HARMONY</div>
                <div class="text">Привет, Друг!<br>Присоединяйся к нам...</div>
                <a href="{{ route('register') }}">
                    <button type="button" class="button button_reg">Зарегистрируйся!</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
