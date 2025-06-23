<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Providers\CustomAuthProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Auth::provider('custom', function ($app, array $config) {
            $model = $config['model'] ?? \App\Models\User::class;
            $connection = $config['connection'] ?? null;

            return new \App\Providers\CustomAuthProvider($model, $connection);
        });
    }
}
