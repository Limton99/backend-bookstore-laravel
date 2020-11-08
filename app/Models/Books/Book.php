<?php

namespace App\Models\Books;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsToMany(Category::class, "category_books");
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }
}
