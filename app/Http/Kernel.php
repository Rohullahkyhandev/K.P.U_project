<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [

        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,

        'admin' => \App\Http\Middleware\Admin::class,

        // user
        'view_user' =>  \App\Http\Middleware\user\user_view::class,
        'create_user' =>  \App\Http\Middleware\user\user_create::class,
        'edit_user' =>  \App\Http\Middleware\user\user_edit::class,
        'delete_user' =>  \App\Http\Middleware\user\user_delete::class,


        // pdc department
        'view_pdc' => \App\Http\Middleware\pdc\view_pdc::class,
        'create' => \App\Http\Middleware\pdc\create_pdc::class,
        'edit_pdc' => \App\Http\Middleware\pdc\edit_pdc::class,
        'delete_pdc' => \App\Http\Middleware\pdc\delete_pdc::class,

        // teacher department
        'view_teacher' => \App\Http\Middleware\teacherDepartment\view_teacher::class,
        'create_teacher' => \App\Http\Middleware\teacherDepartment\create_teacher::class,
        'edit_teacher' => \App\Http\Middleware\teacherDepartment\edit_teacher::class,
        'delete_teacher' => \App\Http\Middleware\teacherDepartment\delete_teacher::class,

        // quality assurance
        'view_quality' => \App\Http\Middleware\qualityDepartment\view_quality_assurenace::class,
        'create_quality' => \App\Http\Middleware\qualityDepartment\create_quality_assurenace::class,
        'edit_quality' => \App\Http\Middleware\qualityDepartment\edit_quality_assurenace::class,
        'delete_quality' => \App\Http\Middleware\qualityDepartment\delete_quality_assurenace::class,

        // post graduated department
        'view_post_graduated' => \App\Http\Middleware\postGraduated\view_post_graduated::class,
        'create_post_graduated' => \App\Http\Middleware\postGraduated\create_post_graduated::class,
        'edit_post_graduated' => \App\Http\Middleware\postGraduated\edit_post_graduated::class,
        'delete_post_graduated' => \App\Http\Middleware\postGraduated\delete_post_graduated::class,


        // research department
        'view_research_department' => \App\Http\Middleware\researchDepartment\view_research::class,
        'create_research_department' => \App\Http\Middleware\researchDepartment\create_research::class,
        'edit_research_department' => \App\Http\Middleware\researchDepartment\edit_research::class,
        'delete_research_department' => \App\Http\Middleware\researchDepartment\delete_research::class,














        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
