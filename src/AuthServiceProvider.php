<?php

namespace Yaslak\Auth;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Yaslak\Auth\Console\InstallCommand;

class AuthServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands(InstallCommand::class);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [Console\InstallCommand::class];
    }
}
