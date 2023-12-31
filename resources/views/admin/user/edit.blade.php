@extends('layouts.admin')
@section('content')
<div class="modal_window_content">
    <div class="window_heading">
        <div class="window_title">Редактирование пользователя</div>
        <div class="window_close">❌</div>
    </div>

    @if(session('error'))
        <div>
            {{ session('error') }}
        </div>
    @endif

    <div class="window_content">
        <form id="book_add" action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('Patch')
            <label for="username">Имя пользователя: @error('username') {{ $message }} @enderror
                <input id="username" type="text" name="username" value="{{ old('username') ?? $user->username }}"/>
            </label>

            <label for="email">Email: @error('email') {{ $message }} @enderror
                <input id="email" type="email" name="email" value="{{ old('email') ?? $user->email }}"/>
            </label>

            <label>Роль: @error('role_id') {{ $message }} @enderror
                <select name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" @selected($user->hasRole($role->name)) >{{ $role->name_rus }}</option>
                    @endforeach
                </select>
            </label>

            <div class="window_buttons">
                <button class="window_button button_save" type="submit">Редактировать</button>
                <a href="{{ route('admin.users.index') }}">
                    <button class="window_button button_close" type="button">Отмена</button>
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
