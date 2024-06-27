<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('welcome', compact('books'));
    }

    public function peminjaman()
    {
        $loans = Loan::with(['member.user', 'loanDetails.book', 'loanDetails.returnDetail'])->get();
        return view('loan', compact('loans'));
    }

    public function bookDetail($id)
    {
        $book = Book::findOrFail($id);
        return view('detail', compact('book'));
    }
}