<?php

declare(strict_types=1);

namespace Financial\Domain\ValueObjects;

use InvalidArgumentException;

final readonly class Money
{
    private function __construct(
        private int $amount,
        private string $currency = 'EUR'
    ) {}

    public static function fromFloat(float $amount, string $currency = 'EUR'): self
    {
        return new self((int) round($amount * 100), $currency);
    }

    public static function fromInteger(int $amount, string $currency = 'EUR'): self
    {
        return new self($amount, $currency);
    }

    public function add(self $other): self
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException("Las monedas deben coincidir para sumar.");
        }

        return new self($this->amount + $other->amount, $this->currency);
    }

    public function toDecimal(): float
    {
        return $this->amount / 100;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}