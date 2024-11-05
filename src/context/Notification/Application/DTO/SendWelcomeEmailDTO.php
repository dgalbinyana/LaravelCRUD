<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\DTO;

final class SendWelcomeEmailDTO
{
    public function __construct(public readonly string $id) { }
}