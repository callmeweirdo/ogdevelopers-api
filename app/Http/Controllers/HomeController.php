<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use App\Http\Resources\HomeResource;
use App\Models\Home;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeInfo = Home::where('user_id', Auth::user()->id)->get()->first();
        return new HomeResource($homeInfo);
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
     * @param  \App\Http\Requests\StoreHomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        // dd($home);
        // $homeInfo = Home::where('user_id', Auth::user()->id)->get()->first();
        // return new HomeResource($homeInfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeRequest  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeRequest $request, Home $home)
    {
        $request->validated($request->all());
        $home->update($request->all());
        // dd($home);
        // $home->update([
        //     'home_welcome' => $request->home_welcome,
        //     'home_title' => $request->home_title,
        //     'home_description' => $request->home_description,
        //     'about_title' => $request->about_title,
        //     'about_description' => $request->about_description,
        // ]);
        return new HomeResource($home);

        // return response()->json([
        //     'message' => "check"
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }
}
