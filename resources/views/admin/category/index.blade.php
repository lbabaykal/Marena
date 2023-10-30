@extends('layouts.admin')
@section('content')
    <div class="static_page_cont">
        <div class="static_page_head">
            <div class="static_page_title">Список категорий</div>
            <div class="static_page_add_new"><a href="{{ route('admin.categories.create') }}">+ Добавить категорию</a></div>
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
                    @foreach($categories as $category)
                        <tr>
                            <td class="ct">{{ $category->id }}</td>
                            <td class="fix_width">{{ $category->title }}</td>
                            <td class="ct">
                                <a href="{{ route('admin.categories.edit', $category->id) }}">
                                    <div class="button button_E"></div>
                                </a>
                            </td>
                            <td class="ct">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
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

    {{ $categories->links() }}

    <div class="modal_windows"></div>
@endsection
