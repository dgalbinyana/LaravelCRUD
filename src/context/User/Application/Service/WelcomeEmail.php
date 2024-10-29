<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\Service;

use Src\Context\User\Domain\Entity\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private readonly User $user)
    {
    }

    public function build():self
    {
        return $this->subject("{$this->user->name()->value()}, bienvenido a nuestra plataforma")
                    ->text('emails.welcome_plain')
                    ->with([
                        'name' => $this->user->name()->value(),
                    ]);
    }
}