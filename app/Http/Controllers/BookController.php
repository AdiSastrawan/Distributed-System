<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::all();
        return response()->json(["data" => $book]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = Book::create([
            "title" => $request->title,
            "author" => $request->author,
            "year" => $request->year
        ]);
        return response()->json(["data" => $book]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json(["data" => $book]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book->update(["title" => $request->title, "author" => $request->author, "year" => $request->year]);
        return response()->json(["data" => $book]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(["data" => $book], 204);
    }
}
