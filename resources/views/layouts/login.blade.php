@auth
    <div id="menu-button" class="header-profile">
        <div id="welcome" class="header-profile-up-text"></div>
        <div class="header-profile-down-text">{{ Auth::user()->username }}</div>
        <div class="header-profile-avatar" style="background-image: url('{{ asset('avatars/' . Auth::user()->avatar) }}')"></div>
        <div id="profile-menu" class="header-profile-menu">
            <div class="profile-menu-info">
                <div class="profile-menu-info-avatar" style="background-image: url('{{ asset('avatars/' . Auth::user()->avatar) }}')"></div>
                <div class="profile-menu-text">
                    <div class="profile-menu-nickname profile-menu-hidden">{{ Auth::user()->username }}</div>
                    <div class="profile-menu-email profile-menu-hidden">{{ Auth::user()->role->title }}</div>
                </div>
            </div>
            <div class="profile-menu">
                @if(Auth::user()->role->isAdmin === 1)
                    <a class="profile-menu-button" href="{{ route('admin.index') }}">
                        <img src="{{ asset('images_icon/admin.png') }}" alt="">
                        <span>Admin_Panel</span>
                    </a>
                @endif
                <a class="profile-menu-button" href="{{ route('account.index') }}">
                    <img src="{{ asset('images_icon/profile.png') }}" alt="">
                    <span>Мой Аккаунт</span>
                </a>
                <a class="profile-menu-button" href="{{ route('account.folders.index') }}">
                    <img src="{{ asset('images_icon/favorite.png') }}" alt="">
                    <span>Избранное</span>
                </a>
                <a class="profile-menu-button" href="{{ route('profile.edit') }}">
                    <img src="{{ asset('images_icon/settings.png') }}" alt="">
                    <span>Настройки</span>
                </a>
                <button class="profile-menu-button" type="submit" form="logout">
                    <img src="{{ asset('images_icon/exit.png') }}" alt="">
                    <span>Выход</span>
                </button>
            </div>
            <form id="logout" class="profile-menu-button" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
    <script>
        let MyDate = new Date,
            MyHours = MyDate.getHours(),
            elements = document.getElementById('welcome'),
            name = elements.innerText;
        switch (true){
            case (MyHours >= 6) && (MyHours < 12):elements.innerText = 'Доброе утро';
                break;
            case (MyHours >= 12) && (MyHours < 18):elements.innerText = 'Добрый день';
                break;
            case (MyHours >= 18) && (MyHours <= 23):elements.innerText = 'Добрый вечер';
                break;
            case (MyHours >= 0) && (MyHours < 6):elements.innerText = 'Доброй ночи';
                break;
            default:elements.innerText = 'Здравствуйте';
                break;
        }
    </script>
@endauth

@guest
    <a href="{{ route('login') }}">
        <div id="menu-change" class="header-profile">
            <div class="header-profile-up-text">Авторизация</div>
            <div class="header-profile-down-text">Регистрация</div>
            <div class="header-profile-avatar" style="background-image: url('{{ asset('avatars/no_avatar.png') }}')"></div>
        </div>
    </a>
@endguest
