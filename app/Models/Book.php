<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'publisher', 'year_published', 'isbn', 'quantity', 'book_shelf_id', 'cover'];

    public function bookShelf()
    {
        return $this->belongsTo(BookShelf::class);
    }
}
