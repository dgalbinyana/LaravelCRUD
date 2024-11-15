<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class UserNotFoundException extends Exception
{
    public function __construct(string $id)
    {
        parent::__construct("User with ID $id not found.", Response::HTTP_NOT_FOUND);
    }
}