<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $sumStockBook = Book::sum('stock');
        $category = Category::all();
        return view('manajemen-buku', compact('books', 'sumStockBook', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tambah-buku', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publication_year' => 'required|integer|between:1900,' . date('Y'),
            'category_id' => 'required',
            'stock' => 'required'
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'publication_year' => $request->publication_year,
            'category_id' => $request->category_id,
            'stock' => $request->stock
        ]);

        return redirect()->route('manajemen.buku')->with('success', 'Berhasil menambahkan buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $book = Book::findOrFail($id);
        return view('edit-buku', compact('categories', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publication_year' => 'required|integer|between:1900,' . date('Y'),
            'category_id' => 'required',
            'stock' => 'required|integer'
        ]);

        Book::findOrFail($id)->update([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'publication_year' => $request->publication_year,
            'category_id' => $request->category_id,
            'stock' => $request->stock
        ]);

        return redirect()->route('manajemen.buku')->with('success', 'Buku berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('manajemen.buku')->with('info', 'Buku berhasil di hapus');
    }
}
