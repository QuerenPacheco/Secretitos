<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Secreto extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
