<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
// use Laravel\Fortify\Contracts\VerifyEmailResponse;
// use Laravel\Fortify\Http\Requests\VerifyEmailRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
    //  * @param  \Laravel\Fortify\Http\Requests\VerifyEmailRequest  $request
    //  * @return \Laravel\Fortify\Contracts\VerifyEmailResponse
     */

    public function verify($id)
    {
        $user = User::findOrFail($id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
            return request()->wantsJson()
                ? new JsonResponse('', 204)
                : redirect(url(env('SPA_URL')) . '/dashboard?verified=1');
        }
        return request()->wantsJson()
            ? new JsonResponse('', 204)
            : redirect(url(env('SPA_URL')) . '/dashboard?verified=1');
    }



    public function resend()
    {
        request()->user()->sendEmailVerificationNotification();
        return response([
            'data' => [
                "message" => 'Your verification Email has been sent'
            ]
        ]);
    }



    // public function __invoke(VerifyEmailRequest $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return app(VerifyEmailResponse::class);
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return app(VerifyEmailResponse::class);
    // }
}
