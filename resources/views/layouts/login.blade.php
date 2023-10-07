@php
    $user = \Illuminate\Support\Facades\Auth::user();
@endphp

@auth
    <div id="menu-change" class="header-profile">
        <div id="welcome" class="header-profile-up-text header-profile-text"></div>
        <div class="header-profile-down-text header-profile-text">{{$user->username}}</div>
        <img class="header-profile-avatar header-profile-text" src="{{asset('avatars/' . $user->avatar)}}" alt="Avatar">
    </div>
    <div id="menu-active" class="header-profile-menu" style="display: none;">
        <div class="profile-menu-info">
            <img src="{{asset('avatars/' . $user->avatar)}}" alt="Avatar">
            <div class="profile-menu-text">
                <div class="profile-menu-nickname profile-menu-hidden">{{$user->username}}<span>#{{$user->id}}</span></div>
                <div class="profile-menu-email profile-menu-hidden">{{$user->role->title}}</div>
            </div>
        </div>
        <div class="profile-menu">
            @if($user->role->isAdmin === 1)
                <a class="profile-menu-button" href="{{route('admin.index')}}">
                    <img src="{{asset('images_icon/admin.png')}}" alt="">
                    <span>Admin_Panel</span>
                </a>
            @endif
            <a class="profile-menu-button" href="/my_profile/">
                <img src="{{asset('images_icon/profile.png')}}" alt="">
                <span>Мой профиль</span>
            </a>
            <a class="profile-menu-button" href="/my_profile/my_favorites">
                <img src="{{asset('images_icon/favorite.png')}}" alt="">
                <span>Избранное</span>
            </a>
            <a class="profile-menu-button" href="/my_profile/settings">
                <img src="{{asset('images_icon/settings.png')}}" alt="">
                <span>Настройки</span>
            </a>
            <a class="profile-menu-button" href="#">
                <img src="{{asset('images_icon/exit.png')}}" alt="">
                <span>Выход</span>
            </a>
        </div>
    </div>
@endauth

@guest
    <div onclick="ShowAuthorization()">
        <div id="menu-change" class="header-profile">
            <div class="header-profile-up-text header-profile-text">Авторизация</div>
            <div class="header-profile-down-text header-profile-text">Регистрация</div>
            <img class="header-profile-avatar header-profile-text" src="{{asset('avatars/no_avatar.png')}}" alt="Avatar">
        </div>
    </div>
@endguest

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
