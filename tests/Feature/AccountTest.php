<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Account;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_view_the_accounts_list()
    {
        $account = Account::factory()->create();

        $this->signInAsASimpleUser();
        $this->get('/accounts')
            ->assertOk()
            ->assertSee($account->code)
            ->assertSee($account->name);

        $this->signInAsAnAdmin();
        $this->get('/accounts')
            ->assertOk()
            ->assertSee($account->code)
            ->assertSee($account->name);
    }

    /** @test */
    public function an_unauthenticated_user_cannot_view_the_accounts_list()
    {
        $this->get('/accounts')->assertRedirect('login');
    }
}
