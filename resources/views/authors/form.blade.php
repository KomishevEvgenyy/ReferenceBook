@extends('layouts.main')

@section('title-block', 'Авторы')

@section('content')
    <form method="POST" id="form" enctype="multipart/form-data"
          @isset($author)
          action="{{ route('authors.update', $author) }}"
          @else
          action="{{ route('authors.store') }}"
        @endisset
    >
        @isset($author)
            @method('PUT')
        @endisset
        @csrf
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Фамилия автора:</label>
            @error('author_surname')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="author_surname" name="author_surname"
                   value="{{ old('author_surname', isset($author) ? $author->author_surname : null) }}"
            >
        </div>
        <div class="form-group">
            <label for="author_name" class="col-form-label">Имя автора:</label>
            @error('author_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="author_name" name="author_name"
                   value="{{ old('author_name', isset($author) ? $author->author_name : null) }}"
            >
        </div>
        <div class="form-group">
            <label for="author_patronymic" class="col-form-label">Отчество автора:</label>
            @error('author_patronymic')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="author_patronymic" name="author_patronymic"
                   value="{{ old('author_patronymic', isset($author) ? $author->author_patronymic : null) }}"
            >
        </div>
        <a class="btn btn-danger" href="{{ route('authors.index') }}">Отмена</a>
        <button class="btn btn-success" id="success">Сохранить</button>
    </form>
@endsection
