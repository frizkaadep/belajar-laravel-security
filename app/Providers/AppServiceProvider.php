<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Providers\Guard\TokenGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Providers\User\SimpleProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Auth::extend("token", function (Application $app, string $name, array $config) {
            $tokenGuard = new TokenGuard(Auth::createUserProvider($config["provider"]), $app->make(Request::class));
            $app->refresh("request", $tokenGuard, "setRequest");
            return $tokenGuard;
        });

        Auth::provider("simple", function (Application $app, array $config) {
            return new SimpleProvider();
        });

        Gate::define("get-contact", function (User $user, Contact $contact) {
            return $user->id === $contact->user_id;
        });
        Gate::define("update-contact", function (User $user, Contact $contact) {
            return $user->id === $contact->user_id;
        });
        Gate::define("delete-contact", function (User $user, Contact $contact) {
            return $user->id === $contact->user_id;
        });

        Gate::define("create-contact", function(User $user){
            if ($user->name === "FrizkaAde") {
                return Response::allow("OK");
            }else {
                return Response::deny("You are not admin");
            }
        });
    }
}
