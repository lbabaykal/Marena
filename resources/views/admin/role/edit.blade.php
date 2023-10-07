@extends('layouts.admin')
@section('content')
<div class="modal_window_content">
    <div class="window_heading">
        <div class="window_title">Редактирование роли</div>
        <div class="window_close">❌</div>
    </div>
    <div class="window_content">
        <form id="book_add" action="{{route('admin.roles.update', $role->id)}}" method="POST">
            @csrf
            @method('Patch')

            <label for="id">id: @error('id') {{$message}} @enderror
                <input id="id" type="text" name="id" value="{{$role->id}}" readonly/>
            </label>

            <label for="title">Название: @error('title') {{$message}} @enderror
                <input id="title" type="text" name="title" value="{{old('title') ?? $role->title}}"/>
            </label>

            <label for="isAdmin">isAdmin? @error('isAdmin') {{$message}} @enderror
                <input type="checkbox" id="isAdmin" name="isAdmin" {{$role->isAdmin === 1 ? 'checked' : ''}} />
            </label>

            <label for="allowView">allowView? @error('allowView') {{$message}} @enderror
                <input type="checkbox" id="allowView" name="allowView" {{$role->allowView === 1 ? 'checked' : ''}} />
            </label>

            <label for="allowCreate">allowCreate? @error('allowCreate') {{$message}} @enderror
                <input type="checkbox" id="allowCreate" name="allowCreate" {{$role->allowCreate === 1 ? 'checked' : ''}} />
            </label>

            <label for="allowUpdate">allowUpdate? @error('allowUpdate') {{$message}} @enderror
                <input type="checkbox" id="allowUpdate" name="allowUpdate" {{$role->allowUpdate === 1 ? 'checked' : ''}} />
            </label>

            <label for="allowDelete">allowDelete? @error('allowDelete') {{$message}} @enderror
                <input type="checkbox" id="allowDelete" name="allowDelete" {{$role->allowDelete === 1 ? 'checked' : ''}} />
            </label>

            <div class="window_buttons">
                <button class="window_button button_save" type="submit">Редактировать</button>
                <a href="{{route('admin.roles.index')}}">
                    <button class="window_button button_close" type="button">Отмена</button>
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
