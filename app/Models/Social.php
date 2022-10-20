<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable  = ['user_id', 'handle', 'profile_link'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
