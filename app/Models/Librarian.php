<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Librarian extends Model
{
    use HasFactory;
    protected $fillable = ["id", "nama", "alamat", "telepon", "image", "created_at", "updated_at"];
}
