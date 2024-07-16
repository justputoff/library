<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Models\Book;
use App\Models\LoanDetail;
use App\Models\ReturnDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member.user', 'loanDetails.returnDetail'])->get();
        return view('pages.loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::with('user')->where('status', 'active')->get();
        $books = Book::all();
        return view('pages.loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.loan_date' => 'required|date',
            'books.*.due_date' => 'required|date|after_or_equal:books.*.loan_date',
            'books.*.quantity' => 'required|integer|min:1',
        ]);

        $loan = Loan::create([
            'member_id' => $request->member_id,
            'status' => 'active',
        ]);

        foreach ($request->books as $book) {
            $bookModel = Book::findOrFail($book['book_id']);
            $bookModel->quantity -= $book['quantity'];
            $bookModel->save();

            LoanDetail::create([
                'loan_id' => $loan->id,
                'book_id' => $book['book_id'],
                'loan_date' => $book['loan_date'],
                'due_date' => $book['due_date'],
                'quantity' => $book['quantity'],
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('loans.index')->with('success', 'Loan created successfully');
    }

    public function edit($id)
    {
        $loan = Loan::with('loanDetails.book')->findOrFail($id);
        $members = Member::with('user')->get();
        $books = Book::all();
        return view('pages.loans.edit', compact('loan', 'members', 'books'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.loan_date' => 'required|date',
            'books.*.due_date' => 'required|date|after_or_equal:books.*.loan_date',
            'books.*.quantity' => 'required|integer|min:1',
        ]);

        $loan = Loan::findOrFail($id);
        $loan->update([
            'member_id' => $request->member_id,
            'status' => 'active',
        ]);

        // Restore book quantities
        foreach ($loan->loanDetails as $detail) {
            $bookModel = Book::findOrFail($detail->book_id);
            $bookModel->quantity += $detail->quantity;
            $bookModel->save();
        }

        // Delete existing loan details
        $loan->loanDetails()->delete();

        // Create new loan details
        foreach ($request->books as $book) {
            $bookModel = Book::findOrFail($book['book_id']);
            $bookModel->quantity -= $book['quantity'];
            $bookModel->save();

            LoanDetail::create([
                'loan_id' => $loan->id,
                'book_id' => $book['book_id'],
                'loan_date' => $book['loan_date'],
                'due_date' => $book['due_date'],
                'quantity' => $book['quantity'],
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully');
    }

    public function show($id)
    {
        $loan = Loan::with(['member.user', 'loanDetails.book', 'loanDetails.returnDetail.user'])->findOrFail($id);
        return view('pages.loans.details', compact('loan'));
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully');
    }

    public function returnBook($id)
    {
        $loanDetail = LoanDetail::findOrFail($id);

        ReturnDetail::create([
            'loan_detail_id' => $loanDetail->id,
            'user_id' => Auth::id(),
            'return_date' => now(),
        ]);

        // Restore book quantity
        $bookModel = Book::findOrFail($loanDetail->book_id);
        $bookModel->quantity += $loanDetail->quantity;
        $bookModel->save();

        // Check if all books are returned
        $loan = $loanDetail->loan;
        $allReturned = $loan->loanDetails->every(function ($detail) {
            return $detail->returnDetail !== null;
        });

        if ($allReturned) {
            $loan->update(['status' => 'completed']);
        }

        return redirect()->route('loans.show', $loanDetail->loan_id)->with('success', 'Book returned successfully');
    }
}