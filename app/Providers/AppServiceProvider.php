<?php

namespace App\Providers;

use App\Http\Middleware\AdminOnly;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {

    }
}
