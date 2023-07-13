<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;
    protected $fillable = ["id", "borrow_start", "borrow_end", "book_id", "student_id", "librarian_id"];
}
