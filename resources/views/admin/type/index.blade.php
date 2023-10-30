@extends('layouts.admin')
@section('content')
    <div class="static_page_cont">
        <div class="static_page_head">
            <div class="static_page_title">Список типов</div>
            <div class="static_page_add_new"><a href="{{ route('admin.types.create') }}">+ Добавить тип</a></div>
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
                    @foreach($types as $type)
                        <tr>
                            <td class="ct">{{ $type->id }}</td>
                            <td class="fix_width">{{ $type->title }}</td>
                            <td class="ct">
                                <a href="{{ route('admin.types.edit', $type->id) }}">
                                    <div class="button button_E"></div>
                                </a>
                            </td>
                            <td class="ct">
                                <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
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

    {{ $types->links() }}

    <div class="modal_windows"></div>
@endsection
