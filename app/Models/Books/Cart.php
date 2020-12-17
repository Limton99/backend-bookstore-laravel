<?php

namespace App\Models\Books;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
