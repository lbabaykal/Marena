<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title', $title . ' Восстановление пароля')</title>
    <meta charset="UTF-8">
    <meta name="description" content="{DESCRIPTION}" />
    <link rel="icon" type="image/png" sizes="256x256" href="{{ asset('images_icon/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="modal_window_content">
        <div class="authorization_left">
            <div class="authorization_container">
                <span>Восстановление пароля</span>
                <div id="warning_rp">&nbsp;</div>
                <form action="{{ route('password.email') }}" method="POST" autocomplete="off">
                    @csrf
                    @error('email') <div class="warning">{{ $message }}</div> @enderror
                    <input id="email" type="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" autofocus >
                    <button type="submit" class="button button_auth">Восстановить пароль</button>
                </form>
            </div>
        </div>
        <div class="authorization_right">
            <a href="/">
                <img src="{{ asset('images_icon/cancel.png') }}" class="window_close" alt="Закрыть">
            </a>
            <div class="image" style="background-image: url('{{ asset('images_icon/moonlight.png') }}');"></div>
        </div>
    </div>
</body>
</html>
