@extends('layouts.admin')
@section('content')
    <div class="static_page_cont">
        <div class="static_page_head">
            <div class="static_page_title">Список студий</div>
            <div class="static_page_add_new"><a href="{{ route('admin.studios.create') }}">+ Добавить студию</a></div>
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
                    @foreach($studios as $studio)
                        <tr>
                            <td class="ct">{{ $studio->id }}</td>
                            <td class="fix_width">{{ $studio->title }}</td>
                            <td class="ct">
                                <a href="{{ route('admin.studios.edit', $studio->id) }}">
                                    <div class="button button_E"></div>
                                </a>
                            </td>
                            <td class="ct">
                                <form action="{{ route('admin.studios.destroy', $studio->id) }}" method="POST">
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

    {{ $studios->links() }}

    <div class="modal_windows"></div>
@endsection
