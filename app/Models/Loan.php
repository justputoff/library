<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'loan_date', 'status'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
}
