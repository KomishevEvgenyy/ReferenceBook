@extends('layouts.main')

@section('title-block', 'Книги')

@section('catalog-name', 'книг')

@section('content')
    <div class="col-sm-12">
        @isset($books)
            <table class="table text-center">
                <thead>
                <tr class="row">
                    <th class="col-3">Название книги</th>
                    <th class="col-3">Краткое описание</th>
                    <th class="col-2">Автора книг</th>
                    <th class="col-4">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr class="row">
                        <td class="col-3">{{ $book->book_name }}</td>
                        <td class="col-3">{{ $book->description }}</td>

                        @if($book->author_id == $book->autohors()->id)
                            <td class="col-2">{{ $book->autohors()->author_surname }} {{ $book->autohors()->author_name }}</td>
                        @endif
                        <td class="col-4">
                            <div class="btn-group" role="group">
                                <form method="POST" action="{{ route('books.destroy', $book) }}">
                                    <a class="btn btn-success" href="{{ route('books.show', $book) }}">Открыть</a>
                                    <a class="btn btn-warning" href="{{ route('books.edit', $book) }}">Редактировать</a>
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
            {{ $books->links() }}
            <div class="btn-group" role="group">
                <a class="btn btn-success" href="{{ route('books.create') }}">Добавить книгу</a>
            </div>
        @else
            <h3>Каталог книг пуст</h3>
            <div class="btn-group" role="group">
                <a class="btn btn-success" href="{{ route('books.create') }}">Добавить</a>
            </div>
        @endisset
    </div>
@endsection
