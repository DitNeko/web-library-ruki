<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $loans = Loan::where('status', 'Dipinjam')
            ->orderBy('status', 'desc')
            ->get();
            
        $loanReturn = Loan::where('status', 'Dikembalikan')->get();
        return view('pegembalian-buku', compact('loans', 'loanReturn'));
    }

    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update([
            'status' => 'Dikembalikan'
        ]);
        return redirect()->back()->with('success', 'Buku berhasil di kembalikan');
    }
}
