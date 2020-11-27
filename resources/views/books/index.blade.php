@extends('layouts.main')

@section('title-block', 'Книги')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Каталог книг</h1>
        <form action="{{ route('books.index') }}" method="GET">
            <input type="submit" value="Сортировать" class="btn btn-primary" name="sort" id="sort">
            <a type="submit" class="btn btn-primary" href="{{ route('books.index') }}">Сбросить</a>
        </form>
    </div>
    <div class="col-sm-12">
        @isset($books)
            <table class="table text-center">
                <thead>
                <tr class="row">
                    <th class="col-3">Название книги</th>
                    <th class="col-4">Краткое описание</th>
                    <th class="col-2">Автора книг</th>
                    <th class="col-3">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr class="row">
                        <td class="col-3">
                            <p class="font-weight-bold">{{ $book->book_name }}<p>
                                <img src="{{ URL::asset('/storage/' . $book->image) }}">
                        </td>
                        <td class="col-4 text-justify">{{ $book->description }}</td>
                        @foreach($authors as $author)
                            @if($book->author_id == $author->id)
                                <td class="col-2">{{ $author->author_surname }} {{ $author->author_name }}</td>
                            @endif
                        @endforeach
                        <td class="col-3">
                            <div class="btn-group" role="group">
                                <form method="POST" action="{{ route('books.destroy', $book) }}">
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
{{--            {{ $books->links() }}--}}
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
