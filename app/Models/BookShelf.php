<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookShelf extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = ['name'];

    // Relasi ke model Book
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
