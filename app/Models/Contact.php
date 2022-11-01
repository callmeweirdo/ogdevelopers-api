<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['email', 'name', 'message', 'user_id', 'id', 'dev_email'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
