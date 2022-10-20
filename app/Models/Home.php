<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'home_welcome', 'home_title', 'home_description', 'about_title', 'about_description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
