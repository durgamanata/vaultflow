<?php

declare(strict_types=1);

namespace Financial\Infrastructure\Persistence\Eloquent;

use Financial\Domain\Entities\Transaction;
use Financial\Domain\Repositories\TransactionRepository;
use Financial\Domain\ValueObjects\TransactionId;
use Financial\Domain\ValueObjects\Money;

final class EloquentTransactionRepository implements TransactionRepository
{
    public function save(Transaction $transaction): void
    {
        EloquentTransactionModel::updateOrCreate(
            ['id' => $transaction->getId()->toString()],
            [
                'amount'      => $transaction->getAmount()->getAmount(),
                'currency'    => 'EUR',
                'description' => 'Prueba desde Comando Artisan',
                'status'      => $transaction->getStatus(),
            ]
        );
    }

    public function findById(TransactionId $id): ?Transaction
    {
        $model = EloquentTransactionModel::find($id->toString());
        if (!$model) return null;

        return new Transaction(
            TransactionId::fromString($model->id),
            Money::fromInteger($model->amount),
            $model->description,
            $model->status,
            new \DateTimeImmutable($model->created_at->toDateTimeString())
        );
    }
}