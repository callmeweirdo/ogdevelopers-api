<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Resources\SkillCollection;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SkillCollection(Skill::where("user_id", Auth::user()->id)->get());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkillRequest $request)
    {
        $user_id = Auth::user()->id;

        $request->validated($request->all());
        // $user_id = $request->id;
        $skill = Skill::create([
            'user_id' => (int)$user_id,
            'skill' => $request->skill,
            'type' => $request->type,
            'experience' => $request->experience,
            'logo' => $request->logo
        ]);

        return response()->json([
            'message' => "skill added successfully",
            'data' => $skill
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        return $this->isNotAuthorized($skill) ? $this->isNotAuthorized($skill) : new SkillResource($skill);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSkillRequest $request, $id)
    {
        $user_id = Auth::user()->id;

        $request->validated($request->all());
        $skill = Skill::where(["id" => $id, "user_id" => $user_id])->update([
            'skill' => $request->skill,
            'type' => $request->type,
            'experience' => $request->experience,
            'logo' => $request->logo,
        ]);


        if ($skill) {
            return response()->json([
                "message" => "success",
                "skill" => $skill
            ]);
        } else {
            return response()->json([
                "message" => "error"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {


        return $this->isNotAuthorized($skill) ? $this->isNotAuthorized($skill) : $skill->delete();
        response()->json([
            "message" => "Skill Deleted Successfully"
        ]);
    }

    private function isNotAuthorized($skill)
    {
        if (Auth::user()->id !== $skill->user_id) {
            return response()->json([
                "status" => "erorr",
                "message" => "you are not Authorized to make this request"
            ], 403);
        }
    }
}
