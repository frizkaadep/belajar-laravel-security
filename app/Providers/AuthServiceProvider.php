<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\User;
use App\Models\Contact;
use App\Policies\TodoPolicy;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;
use App\Providers\Guard\TokenGuard;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Providers\User\SimpleProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Tambahkan model dan policy di sini
        // 'App\Models\NamaModel' => 'App\Policies\NamaPolicy',
        User::class => UserPolicy::class,
        Todo::class => TodoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
