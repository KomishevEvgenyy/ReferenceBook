@extends('layouts.main')

@section('title-block', 'Авторы')

@section('catalog-name', 'авторов')

@section('content')
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
            {{$authors->links()}}
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
