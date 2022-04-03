<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Transaction;

class TransactionRepository
{
    public function create($attributes)
    {
        $transaction = Transaction::create([
            'name' => $attributes['name'],
            'journal_id' => $attributes['journal_id'],
            'date' => Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString(),
        ]);

        foreach ($attributes['lines'] as $line) {
            $transaction->lines()->create($line);
        }

        return $transaction->id;
    }
}
