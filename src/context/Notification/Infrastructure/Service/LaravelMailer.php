<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Infrastructure\Service;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Src\Context\Notification\Domain\Repository\MailerRepository;
use Src\Context\User\Domain\Entity\User;

final class LaravelMailer extends Mailable implements MailerRepository
{
    use Queueable, SerializesModels;

    private User $user;

    public function sendWelcomeEmail(User $user): void
    {
        $this->user = $user;
        Mail::to($this->user->email()->value())->send($this->build());
    }

    public function build(): self
    {
        return $this->subject("{$this->user->name()->value()}, bienvenido a nuestra plataforma")
                    ->text('emails.welcome_plain')
                    ->with([
                        'name' => $this->user->name()->value(),
                    ]);
    }
}