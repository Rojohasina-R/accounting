<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Transaction;

class TransactionRepository
{
    public function updateOrCreate(Transaction $transaction, $attributes)
    {
        $transaction->name = $attributes['name'];
        $transaction->journal_id = $attributes['journal_id'];
        $transaction->date = Carbon::createFromFormat('d/m/Y', $attributes['date'])->toDateString();
        $transaction->save();

        $transaction->lines()->delete();
        foreach ($attributes['lines'] as $line) {
            $transaction->lines()->create($line);
        }

        return $transaction->id;
    }
}
