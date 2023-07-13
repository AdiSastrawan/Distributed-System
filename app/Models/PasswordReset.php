<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }
    protected $primaryKey = "email";
    protected $table = "password_reset_tokens";
    protected $fillable = ["email", "token", "created_at"];
    public $timestamp = false;
}
