<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if (!empty($request->sort)) {
            $authors = Author::paginate(15)->sortBy('author_surname');
        } elseif (!empty($request->search)) {
            $authors = Author::where('author_surname', $request->search)->
            orWhere('author_name', $request->search)->get();
        } else {
            $authors = Author::paginate(15);
        }
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('authors.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorRequest $request
     * @return Response
     */
    public function store(AuthorRequest $request)
    {
        Author::create($request->all());
        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Author $author
     * @return Response
     */
    public function show(Author $author)
    {
        $books = Book::get();
        return view('authors.show', compact('author', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Author $author
     * @return Response
     */
    public function edit(Author $author)
    {
        return view('authors.form', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param \App\Author $author
     * @return Response
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->all());
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Author $author
     * @return Response
     * @throws \Exception
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
    }

    public function search(Request $request)
    {
        dd($request);
        $authors = DB::table('authors')->where('author_surname', $request->search)->get();
        return view('authors.search', compact('authors'));
    }
}
