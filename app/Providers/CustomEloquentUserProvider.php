<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class CustomEloquentUserProvider extends EloquentUserProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return parent::validateCredentials($user, $credentials);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
