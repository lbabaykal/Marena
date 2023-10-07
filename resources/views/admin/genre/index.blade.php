@extends('layouts.admin')
@section('content')
    <div class="static_page_cont">
        <div class="static_page_head">
            <div class="static_page_title">Список жанров</div>
            <div class="static_page_add_new"><a href="{{route('admin.genres.create')}}">+ Добавить жанр</a></div>
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
                    @foreach($genres as $genre)
                        <tr>
                            <td class="ct">{{$genre->id}}</td>
                            <td class="fix_width">{{$genre->title}}</td>
                            <td class="ct">
                                <a href="{{route('admin.genres.edit', $genre->id)}}">
                                    <div class="button button_E"></div>
                                </a>
                            </td>
                            <td class="ct">
                                <form action="{{route('admin.genres.destroy', $genre->id)}}" method="POST">
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

    {{$genres->links()}}

    <div class="modal_windows"></div>
@endsection
