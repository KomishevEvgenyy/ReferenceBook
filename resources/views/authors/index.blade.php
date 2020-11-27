@extends('layouts.main')

@section('title-block', 'Авторы')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Каталог авторов</h1>
        <form action="{{ route('authors.index') }}" method="GET">
            <input type="submit" value="Сортировать" class="btn btn-primary" name="sort" id="sort">
            <a type="submit" class="btn btn-primary" href="{{ route('authors.index') }}">Сбросить</a>
        </form>
    </div>
    <div class="col-md-12">
        @isset($authors)
            <table class="table text-center">
                <tbody>
                <tr>
                    <th>
                        Фамилия
                    </th>
                    <th>
                        Имя
                    </th>
                    <th>
                        Отчество
                    </th>
                    <th>
                        Действие
                    </th>
                </tr>
                @foreach($authors as $author)
                    <tr>
                        <td>{{ $author->author_surname }}</td>
                        <td>{{ $author->author_name }}</td>
                        <td>{{ $author->author_patronymic }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form method="POST" action="{{ route('authors.destroy', $author) }}">
                                    <a type="button" class="btn btn-warning mr-3"
                                       href="{{ route('authors.edit', $author) }}">Редактировать</a>
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" value="Удалить" type="submit">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            {{$authors->links()}}--}}
            <div class="btn-group" role="group">
                <a type="button" class="btn btn-success" href="{{ route('authors.create') }}">Добавить автора</a>
            </div>
        @else
            <h3>Список авторов пуст</h3>
            <div class="btn-group" role="group">
                <a type="button" class="btn btn-success" href="{{ route('authors.create') }}">Добавить автора</a>
            </div>
        @endisset
    </div>
@endsection
