<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
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
            'date' => date('d/m/Y'),
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

        /*$this->assertDatabaseHas('lines', [
            'account_id' => $debited_account_id,
            'debit' => 40000,
        ]);

        $this->assertDatabaseHas('lines', [
            'account_id' => $credited_account_id,
            'credit' => 40000,
        ]);*/
    }

    /** @test */
    public function a_transaction_requires_a_name()
    {
        $attributes = Transaction::factory()->raw(['name' => '']);
        $this->post('/transactions', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_transaction_requires_a_date()
    {
        $attributes = Transaction::factory()->raw(['date' => '']);
        $this->post('/transactions', $attributes)->assertSessionHasErrors('date');
    }

    /** @test */
    public function a_transaction_requires_a_past_date()
    {
        $attributes = Transaction::factory()->raw(['date' => date('d/m/Y', strtotime('+1 days'))]);
        $this->post('/transactions', $attributes)->assertSessionHasErrors('date');
    }

    /** @test */
    public function a_transaction_requires_a_journal_id()
    {
        $attributes = Transaction::factory()->raw(['journal_id' => '']);
        $this->post('/transactions', $attributes)->assertSessionHasErrors('journal_id');
    }

    /** @test */
    public function a_transaction_requires_a_journal_which_already_exists_in_the_database()
    {
        $attributes = Transaction::factory()->raw(['journal_id' => 1]);
        $this->post('/transactions', $attributes)->assertSessionHasErrors('journal_id');
    }
}
