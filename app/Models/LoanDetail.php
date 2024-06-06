<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'book_id', 'loan_date', 'due_date', 'quantity', 'user_id'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function returnDetail()
    {
        return $this->hasOne(ReturnDetail::class);
    }
}
