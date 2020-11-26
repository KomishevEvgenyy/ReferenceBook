@extends('layouts.main')

@section('title-block', 'Книги')

@section('content')
    <form method="POST" id="form" enctype="multipart/form-data"
          @isset($book)
          action="{{ route('books.update', $book) }}"
          @else
          action="{{ route('books.store') }}"
        @endisset
    >
        @isset($book)
            @method('PUT')
        @endisset
        @csrf
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Название книги:</label>
            @error('book_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="book_name" name="book_name"
                   value="{{ old('book_name', isset($book) ? $book->book_name : null) }}"
            >
        </div>
        <div class="form-group">
            <label for="book_name" class="col-form-label">Описание:</label>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description"
                      name="description">{{ old('description', isset($book) ? $book->description : null) }}</textarea>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="name">Авторы:</label>
            <div class="col-sm-6">
                <select name="author_id" id="author_id" class="form-control">
                    @foreach($authors as $author)
                        <option value="{{ $author->id}}">
                            {{ $author->author_surname }} {{ $author->author_name }} {{ $author->author_patronymic }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="image">Фото:</label>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-sm-10">
                <label class="btn btn-success btn-file">
                    Загрузить <input type="file" style="display: none" id="image" name="image" value="">
                </label>
            </div>
        </div>

        <a class="btn btn-danger" href="{{ route('books.index') }}">Отмена</a>
        <button class="btn btn-success" id="success">Сохранить</button>
    </form>
@endsection
