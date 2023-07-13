<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    protected $fillable = ["id", "nama", "alamat", "telepon", "created_at", "updated_at"];
}
