<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DevsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Illuminate\Auth\Notifications\ResetPassword;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:' . config('fortify.guard')
    ]));
if (Features::enabled(Features::resetPasswords())) {

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware(['guest:' . config('fortify.guard')])
        ->name('password.reset');

    // Route::get(
    //     '/reset-password/{token}',
    //     function ($token, $notifiable) {
    //         // return $token;
    //         return "http://localhost:3000/reset-password/${$token}?email={$notifiable->getEmailForPasswordReset()}";
    //     }
    // )
    // ->middleware(['guest:' . config('fortify.guard')])
    // ->name('password.reset');


    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware(['guest:' . config('fortify.guard')])
        ->name('password.email');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->middleware(['guest:' . config('fortify.guard')])
        ->name('password.update');
}

Route::middleware('auth:sanctum')->group(function () {
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
            ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            ->name('user-profile-information.update');
    }

    $enableViews = config('fortify.views', true);

    //     // Password Reset...


    //     // Registration...
    //     if (Features::enabled(Features::registration())) {
    //         if ($enableViews) {
    //             Route::get('/register', [RegisteredUserController::class, 'create'])
    //             ->middleware(['guest:' . config('fortify.guard')])
    //             ->name('register');
    //         }

    //         Route::post('/register', [RegisteredUserController::class, 'store'])
    //             ->middleware(['guest:' . config('fortify.guard')]);
    //     }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        // if ($enableViews) {
        //     Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
        //         ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
        //         ->name('verification.notice');
        // }

        // Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])
        //     ->name('verification.send');

        // Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware(['signed'])
        //     ->name('verification.verify');

        // Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])
        //     ->name('verification.send');

        // Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])
        //     ->name('verification.send');
    }

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
            ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            ->name('user-profile-information.update');
    }

    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put('/user/password', [PasswordController::class, 'update'])
            ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            ->name('user-password.update');
    }

    // Password Confirmation...
    // if ($enableViews) {
    //     Route::get('/user/confirm-password', [ConfirmablePasswordController::class, 'show'])
    //         ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')]);
    // }

    Route::get('/user/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])
        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
        ->name('password.confirmation');

    Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
        ->name('password.confirm');

    // Two Factor Authentication...
    if (Features::enabled(Features::twoFactorAuthentication())) {


        $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
            ? [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'password.confirm']
            : [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')];

        Route::post(
            '/user/two-factor-authentication',
            [TwoFactorAuthenticationController::class, 'store']
        )
            ->middleware($twoFactorMiddleware)
            ->name('two-factor.enable');

        Route::post('/user/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthenticationController::class, 'store'])
            ->middleware($twoFactorMiddleware)
            ->name('two-factor.confirm');

        Route::delete('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
            ->middleware($twoFactorMiddleware)
            ->name('two-factor.disable');

        Route::get('/user/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
            ->middleware($twoFactorMiddleware)
            ->name('two-factor.qr-code');

        Route::get('/user/two-factor-secret-key', [TwoFactorSecretKeyController::class, 'show'])
            ->middleware($twoFactorMiddleware)
            ->name('two-factor.secret-key');

        Route::get('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
            ->middleware($twoFactorMiddleware)
            ->name('two-factor.recovery-codes');

        Route::post('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
            ->middleware($twoFactorMiddleware);
    }
    Route::apiResource('/dev', UserController::class);
    Route::apiResource("/skills", SkillController::class);
    Route::apiResource("/projects", ProjectController::class);
    Route::apiResource("/socials", SocialController::class);
    Route::apiResource("/home", HomeController::class);

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});


// Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware(['signed'])
//     ->name('verification.verify');
Route::get("/developers/projects/{id}", [DevsController::class, "project"]);
Route::post("/developers/contact/", [DevsController::class, "contact"]);
Route::apiResource("/developers", DevsController::class);

Route::get('/', function () {
    return;
});
