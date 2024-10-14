<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Context\User\Domain\UserRepository;
use Src\Context\User\Infrastructure\MySQLUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, MYSQLUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
