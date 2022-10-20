<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ["project", "tech_stack", "live_link", "github_link", "user_id", "project_cover", "description"];
    use HasFactory;

    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class);
    }
}
