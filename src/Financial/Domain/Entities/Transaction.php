<?php

declare(strict_types=1);

namespace Financial\Domain\Entities;

use Financial\Domain\ValueObjects\Money;
use Financial\Domain\ValueObjects\TransactionId;
use DateTimeImmutable;

class Transaction
{
    public function __construct(
        private readonly TransactionId $id,
        private readonly Money $amount,
        private string $description,
        private string $status, // 'pending', 'approved', 'rejected'
        private readonly DateTimeImmutable $createdAt
    ) {}

    public static function create(Money $amount, string $description): self
    {
        return new self(
            TransactionId::generate(),
            $amount,
            $description,
            'pending',
            new DateTimeImmutable()
        );
    }

    // Aquí irían las reglas de negocio (invariantes)
    public function approve(): void
    {
        if ($this->status !== 'pending') {
            throw new \DomainException("Only pending transactions can be approved.");
        }
        $this->status = 'approved';
    }

    // Getters necesarios...
    public function getId(): TransactionId { return $this->id; }
    public function getAmount(): Money { return $this->amount; }
    public function getStatus(): string { return $this->status; }
}