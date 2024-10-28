<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Service;

use Illuminate\Support\Facades\Hash;
use Src\Context\User\Domain\Exceptions\UserPasswordDoesNotMatch;
use Src\Context\User\Domain\ValueObjects\UserPassword;

final class VerifyUserPassword
{
    /**
     * @throws UserPasswordDoesNotMatch
     */
    public function handle(UserPassword $actualPassword, UserPassword $hashedUserPassword): void
    {
        if (!Hash::check($actualPassword->value(), $hashedUserPassword->value())) {
            throw new UserPasswordDoesNotMatch();
        }
    }
}