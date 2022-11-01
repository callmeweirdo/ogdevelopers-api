<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\DevsCollection;
use App\Http\Resources\DevsResource;
use App\Http\Resources\ProjectResource;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DevsController extends Controller
{
    public function index()
    {
        $devs = User::with(['skills', 'projects', 'socials', 'home'])->get();
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

    public function contact(ContactRequest $request)
    {
        $request->validated($request->all());

        $data =  Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'user_id' => $request->user_id,
            'dev_email' => $request->devEmail
        ]);



        // $sent =  Mail::send('email.name', ['data1' => $data], function ($m) {
        //     $m->to('ogbandav102@gmail.com')->send(new ContactMail($m));
        // });

        $sent =  Mail::to($data)->send(new ContactMail($data));

        // if ($sent) {
        //     return response()->json(["message" => "Email sent successfully."]);
        // } else {
        //     return response()->json(['message' => "unable to send email"]);
        // }

        //Json Response For Angular frontend
    }
}
