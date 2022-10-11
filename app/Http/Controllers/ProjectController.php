<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProjectCollection(Project::where("user_id", Auth::user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $user_id = Auth::user()->id;

        $request->validated($request->all());

        $project = Project::create([
            'user_id' => (int)$user_id,
            'project' => $request->project,
            'tech_stack' => $request->tech_stack,
            'live_link' => $request->live_link,
            'github_link' => $request->github_link,
            'project_cover' => $request->project_cover,
            'description' => $request->description
        ]);

        return response()->json([
            "message" => "project has been added successfully",
            "project" => $project
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $user_id = Auth::user()->id;

        $request->validated($request->all());

        $project->update($request->all());

        return new ProjectResource($project);

        // $project = Project::update([
        //     'user_id' => (int)$user_id,
        //     'project' => $request->project,
        //     'tech_stack' => $request->tech_stack,
        //     'live_link' => $request->live_link,
        //     'github_link' => $request->github_link,
        //     'project_cover' => $request->project_cover,
        //     'description' => $request->description
        // ]);

        // if ($project) {
        //     return response()->json([
        //         "message" => "project has been updated successfully",
        //         "project" => $project
        //     ]);
        // } else {
        //     return response()->json([
        //         "message" => "project has not been updated",
        //         "status" => "error"
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->isNotAuthorized($project) ? $this->isNotAuthorized($project) : $project->delete();
        response()->json([
            "status" => "erorr",
            "message" => "project Deleted Successfully"
        ], 403);
    }

    private function isNotAuthorized($project)
    {
        if (Auth::user()->id !== $project->user_id) {
            return response()->json([
                "status" => "erorr",
                "message" => "you are not Authorized to make this request"
            ], 403);
        }
    }
}
