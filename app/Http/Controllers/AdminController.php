<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Loan;

class AdminController extends Controller
{
    public function index() {
        $loans = Loan::all();
        $loanActive = Loan::where('status', 'Dipinjam')->count();
        $loanNotActive = Loan::where('status', 'Dikembalikan')->count();
        $books = Book::count();
        return view('dashboard', compact('loans', 'loanActive', 'books', 'loanNotActive'));
    }
}
