@extends('layouts.admin')
@section('content')
    <div class="static_page_cont">
        <div class="static_page_head">
            <div class="static_page_title">Список ролей</div>
            @can('create', \App\Models\Role::class)
            <div class="static_page_add_new"><a href="{{ route('admin.roles.create') }}">+ Добавить роль</a></div>
            @endcanany
        </div>
        <div class="static_page_content">
            <table id="Books" class="flat-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="ct">{{ $role->id }}</td>
                            <td class="fix_width">{{ $role->title }}</td>
                            <td class="ct">
                                @can('update', $role)
                                    <a href="{{ route('admin.roles.edit', $role->id) }}">
                                        <div class="button button_E"></div>
                                    </a>
                                @endcanany
                            </td>
                            <td class="ct">
                                @can('delete', $role)
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <input type="submit" value="" class="button button_D">
                                    </form>
                                @endcanany
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $roles->links() }}

    <div class="modal_windows"></div>
@endsection
