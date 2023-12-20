@extends('layouts.admin')
@section('content')
    <div class="static_page_cont">
        <div class="static_page_head">
            <div class="static_page_title">Список пользователей</div>
        </div>
        <div class="static_page_content">
            <table id="Books" class="flat-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Роль</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="ct">{{ $user->id }}</td>
                            <td class="fix_width">{{ $user->username }}</td>
                            <td class="fix_width">{{ $user->rolesRus->first() }}</td>
                            <td class="ct">
                                    <a href="{{ route('admin.users.edit', $user->id) }}">
                                        <div class="button button_E"></div>
                                    </a>
                            </td>
                            <td class="ct">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <input type="submit" value="" class="button button_D">
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $users->links() }}

    <div class="modal_windows"></div>
@endsection
