<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\DTO;

final class FindUserDTO
{
    public function __construct(public readonly string $id)
    {
    }
}