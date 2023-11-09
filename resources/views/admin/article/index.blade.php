@extends('layouts.admin')
@section('content')
    <div class="static_page_cont">
        <div class="static_page_head">
            <div class="static_page_title">Список статей</div>
            @can('create', \App\Models\Article::class)
            <div class="static_page_add_new"><a href="{{ route('admin.articles.create') }}">+ Добавить статью</a></div>
            @endcan
        </div>
        <div class="static_page_content">
            <table id="Books" class="flat-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Год</th>
                    <th>Тип</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="ct">{{ $article->id }}</td>
                            <td class="fix_width"><a href="{{ route('article.show', $article->id) }}" target="_blank">{{ $article->title_rus }}</a></td>
                            <td class="fix_width">{{ $article->category->title }}</td>
                            <td>{{ $article->release }}</td>
                            <td>{{ $article->type->title }}</td>
                            <td class="ct">
                                @can('update', $article)
                                        <a href="{{ route('admin.articles.edit', $article->id) }}">
                                        <div class="button button_E"></div>
                                    </a>
                                @endcan
                            </td>
                            <td class="ct">
                                @can('delete', $article)
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <input type="submit" value="" class="button button_D">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $articles->links() }}

    <div class="modal_windows"></div>
@endsection
