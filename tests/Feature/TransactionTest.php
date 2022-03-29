<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Account;
use App\Models\Journal;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_transaction()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => "Libellé de l'écriture",
            'journal_id' => $journal_id = Journal::factory()->create()->id,
            'date' => date('Y-m-d'),
            'lines' => [
                [
                    'account_id' => $debited_account_id = Account::factory()->create()->id,
                    'debit' => 40000,
                ],
                [
                    'account_id' => $credited_account_id = Account::factory()->create()->id,
                    'credit' => 40000,
                ],
            ]
        ];

        $this->post('/transactions', $data);

        $this->assertDatabaseHas('transactions', [
            'name' => "Libellé de l'écriture",
            'journal_id' => $journal_id,
            'date' => date('Y-m-d'),
        ]);

        $this->assertDatabaseHas('lines', [
            'account_id' => $debited_account_id,
            'debit' => 40000,
        ]);

        $this->assertDatabaseHas('lines', [
            'account_id' => $credited_account_id,
            'credit' => 40000,
        ]);
    }
}
