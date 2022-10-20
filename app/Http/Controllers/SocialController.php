<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSocialRequest;
use App\Http\Requests\UpdateSocialRequest;
use App\Http\Resources\SocialCollection;
use App\Http\Resources\SocialResource;
use App\Models\Social;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SocialCollection(Social::where('user_id', Auth::user()->id)->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSocialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialRequest $request)
    {
        $user_id = Auth::user()->id;
        $request->validated($request->all());
        $social = Social::create([
            'user_id' => $user_id,
            'handle' => $request->handle,
            'profile_link' => $request->profile_url
        ]);

        if ($social) {
            return new SocialResource($social);
        } else {
            return response()->json([
                'message' => "Social handle was not added",
                'status' => 'Error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        return new SocialResource($social);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSocialRequest  $request
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialRequest $request, Social $social)
    {
        $user_id = Auth::user()->id;
        $request->validated($request->all());

        $social->update([
            'handle' => $request->handle,
            'profile_link' => $request->profile_url
        ]);

        return new SocialResource($social);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        $social->delete();
        return response()->json([
            "status" => "success",
            "message" => "handle Deleted Successfully"
        ]);
    }
}
