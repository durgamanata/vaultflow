<?php

declare(strict_types=1);

namespace Financial\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class EloquentTransactionModel extends Model
{
    protected $table = 'transactions';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'amount', 'currency', 'description', 'status'];
}