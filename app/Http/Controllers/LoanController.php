<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::where('status', 'Dipinjam')->get();
        $statusDipinjam = Loan::where('status', 'Dipinjam')->count();
        $booksAvailable = Book::sum('stock');
        return view('peminjaman-buku', compact('loans', 'statusDipinjam', 'booksAvailable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all();
        return view('tambah-peminjaman', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-Z\s\-\'\.]+$/',
            ],
            'book_id' => 'required',
            'loan_date' => 'required|date',
            'return_date' => 'required|date',
        ]);

        Loan::create([
            'name' => $request->name,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
        ]);

        return redirect()->route('peminjaman.buku')->with('success', 'Berhasil menambahkan peminjaman');
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
        $books = Book::all();
        $loan = Loan::findOrFail($id);
        return view('edit-peminjaman', compact('books', 'loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-Z\s\-\'\.]+$/',
            ],
            'book_id' => 'required',
            'loan_date' => 'required|date',
            'return_date' => 'required|date',
        ]);

        Loan::findOrFail($id)->update([
            'name' => $request->name,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
        ]);

        return redirect()->route('peminjaman.buku')->with('info', 'Data peminjaman berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect()->back()->with('info', 'Peminjaman telah di Hapus');
    }
}
