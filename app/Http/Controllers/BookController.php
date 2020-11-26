<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(15);
        $authors = Author::get();
        return view('books.index', compact('books', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::get();
        return view('books.form', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')) {
            $params['image'] = $request->file('image')->store('books', 'public');
        }

        Book::create($params);
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::get();
        return view('books.form', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete('public/' . $book->image);
            $params['image'] = $request->file('image')->store('books', 'public');
//          метод file указывает на тип поля в форме(для загрузки файлов это type='file') далее указываем
//          метод store который первым параметром принимает имя папки где будут сохранятся файлы, а вторым параметром
//          указываесятся имя используемого диска(который прописан в файле config/filesystem)
        }
        $book->update($params);
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Storage::delete('public/' . $book->image);
        $book->delete();
        return redirect()->route('books.index');
    }
}
