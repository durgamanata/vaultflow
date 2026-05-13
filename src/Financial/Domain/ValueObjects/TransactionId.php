<?php

declare(strict_types=1);

namespace Financial\Domain\ValueObjects;

use Illuminate\Support\Str;
use InvalidArgumentException;

final readonly class TransactionId
{
    private function __construct(private string $value)
    {
        if (!Str::isUuid($value)) {
            throw new InvalidArgumentException("Invalid TransactionId format");
        }
    }

    public static function generate(): self
    {
        return new self((string) Str::uuid());
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }
}