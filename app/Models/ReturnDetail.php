<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnDetail extends Model
{
    use HasFactory;

    protected $fillable = ['loan_detail_id', 'user_id', 'return_date'];

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
