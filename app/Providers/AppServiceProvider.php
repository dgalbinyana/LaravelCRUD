<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Src\Context\Notification\Application\Subscriber\SendWelcomeEmailOnUserRegistration;
use Src\Context\Notification\Domain\Repository\MailerRepository;
use Src\Context\Notification\Infrastructure\Service\LaravelMailer;
use Src\Context\User\Domain\Event\UserCreated;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Infrastructure\Repository\MySQLUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, MYSQLUserRepository::class);
        $this->app->bind(MailerRepository::class, LaravelMailer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            UserCreated::class,
            SendWelcomeEmailOnUserRegistration::class
        );
    }
}
