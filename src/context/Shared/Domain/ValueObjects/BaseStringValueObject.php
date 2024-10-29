<?php

declare(strict_types = 1);

namespace Src\Context\Shared\Domain\ValueObjects;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseStringValueObject
{
    protected function ensureIsNotEmpty(string $value, string $fieldName): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException($fieldName . ' cannot be empty', Response::HTTP_BAD_REQUEST);
        }
    }

    protected function ensureMaxLength(string $value, string $fieldName, int $maxLength): void
    {
        if (strlen($value) > $maxLength) {
            throw new InvalidArgumentException($fieldName . ' cannot exceed ' . $maxLength . ' characters',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}