<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title', $title . ' Регистрация')</title>
    <meta charset="UTF-8">
    <meta name="description" content="{DESCRIPTION}" />
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('images_icon/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="modal_window_content">
        <div class="authorization_right">
            <div class="image" style="background-image: url('{{ asset('images_icon/community.png') }}');"></div>
        </div>
        <div class="authorization_left">
            <a href="/">
                <img src="{{ asset('images_icon/cancel.png') }}" class="window_close" alt="Закрыть">
            </a>
            <div class="authorization_container">
                <span>Регистрация</span>
                <form action="{{ route('register') }}" method="POST" autocomplete="off">
                    @csrf
                    @error('username') <div class="warning">{{ $message }}</div> @enderror
                    <input id="username" type="text" name="username" placeholder="Имя пользователя" value="{{ old('username') }}" required />
                    @error('email') <div class="warning">{{ $message }}</div> @enderror
                    <input id="email" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required />
                    @error('password') <div class="warning">{{ $message }}</div> @enderror
                    <input id="password" type="password" name="password" autocomplete="off" placeholder="Пароль" required />
                    @error('password_confirmation') <div class="warning">{{ $message }}</div> @enderror
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Повторите пароль" autocomplete="off" required />
                    <a href="#" class="text_a">✓ Политика конфиденциальности</a>
                    <button type="submit" class="button button_auth">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
