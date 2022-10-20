<?php

namespace App\Http\Controllers;

use App\Http\Resources\DevsCollection;
use App\Http\Resources\DevsResource;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DevsController extends Controller
{
    public function index()
    {
        $devs = User::with(['skills', 'projects', 'socials', 'home'])->paginate();
        return new DevsCollection($devs);
    }

    public function show($user)
    {
        // $user = User::with(['skills', 'projects', 'socials', 'home']);
        $user = User::with(['skills', 'projects', 'socials', 'home'])->findOrFail($user);
        return new DevsResource($user);
    }

    public function project($project)
    {
        $project = Project::with(['user'])->findOrFail($project);

        return new ProjectResource($project);
    }
}
