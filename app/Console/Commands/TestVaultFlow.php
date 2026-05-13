<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Financial\Domain\Entities\Transaction;
use Financial\Domain\ValueObjects\Money;
use Financial\Domain\Repositories\TransactionRepository;

class TestVaultFlow extends Command
{
    protected $signature = 'vaultflow:test';
    protected $description = 'Prueba el flujo completo de creación de una transacción en el Dominio y su guardado en Infraestructura';

    public function handle(TransactionRepository $repository)
    {
        $this->info('🚀 Iniciando prueba de VaultFlow...');
        $amount = Money::fromFloat(150.50);
        $transaction = Transaction::create($amount, 'Compra de equipo de oficina');

        $this->comment('Entidad de Dominio creada: ' . $transaction->getId()->toString());

        $repository->save($transaction);

        $this->success('Transacción guardada en la base de datos con éxito.');
    }
}