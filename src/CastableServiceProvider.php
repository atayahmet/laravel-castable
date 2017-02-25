<?php

namespace Castable;

use Illuminate\Support\ServiceProvider;
use Castable\CastRequestMakeCommand;

class CastableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(CastRequestMakeCommand::class);
    }
}
