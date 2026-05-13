<?php

declare(strict_types=1);

namespace Financial\Domain\Repositories;

use Financial\Domain\Entities\Transaction;
use Financial\Domain\ValueObjects\TransactionId;

interface TransactionRepository
{
    public function save(Transaction $transaction): void;
    public function findById(TransactionId $id): ?Transaction;
}