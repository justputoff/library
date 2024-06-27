<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data total
        $totalLoans = LoanDetail::count();
        $totalReturns = LoanDetail::whereHas('returnDetail')->count();
        $totalBooks = Book::count();
        $totalMembers = Member::count();

        // Menyesuaikan query berdasarkan jenis database
        if (config('database.default') === 'pgsql') {
            $loansPerMonth = LoanDetail::selectRaw('TO_CHAR(created_at, \'MM\') as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('count', 'month')
                ->toArray();
        } else {
            $loansPerMonth = LoanDetail::selectRaw('strftime(\'%m\', created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('count', 'month')
                ->toArray();
        }

        // Menyiapkan data untuk chart
        $months = [];
        $loanCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = 'Bulan ' . $i;
            $loanCounts[] = $loansPerMonth[sprintf('%02d', $i)] ?? 0; // Menggunakan format dua digit untuk bulan
        }

        return view('dashboard', compact('totalLoans', 'totalReturns', 'totalBooks', 'totalMembers', 'months', 'loanCounts'));
    }
}
