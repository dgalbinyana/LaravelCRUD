<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\DTO;

use Src\Context\User\Domain\Entity\User;

final class SendWelcomeEmailDTO
{
    public function __construct(public readonly User $user) { }
}