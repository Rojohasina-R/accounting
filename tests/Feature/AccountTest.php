<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Line;
use App\Models\Account;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_and_a_simple_user_cannot_delete_an_account()
    {
        $account = Account::factory()->create();
        $this->delete('/accounts/' . $account->id)->assertStatus(403);

        $this->signInAsASimpleUser();
        $this->delete('/accounts/' . $account->id)->assertStatus(403);
    }

    /** @test */
    public function an_admin_cannot_delete_an_account_which_is_related_to_one_or_many_lines()
    {
        $account = Account::factory()->create();

        Line::factory()->create(['account_id' => $account->id]);

        $this->signInAsAnAdmin();

        $this->delete('/accounts/' . $account->id)->assertSessionHasErrors('account');
    }

    /** @test */
    public function an_admin_can_delete_an_account_which_is_not_related_to_any_line()
    {
        $account = Account::factory()->create();

        $this->signInAsAnAdmin();

        $this->delete('/accounts/' . $account->id);
        $this->assertDatabaseMissing('accounts', [
            'id' => $account->id
        ]);
    }

    /** @test */
    public function an_unauthenticated_user_and_a_simple_user_cannot_update_an_account()
    {
        $account = Account::factory()->create();

        $this->put('/accounts/' . $account->id)->assertStatus(403);

        $this->signInAsASimpleUser();
        $this->put('/accounts/' . $account->id)->assertStatus(403);
    }

    /** @test */
    public function an_admin_can_update_an_account()
    {
        $account = Account::factory()->create();

        $this->signInAsAnAdmin();

        $data = Account::factory()->raw();
        $this->put('/accounts/' . $account->id, $data);
        $this->assertDatabaseHas('accounts', $data);
    }

    /** @test */
    public function an_account_requires_a_valid_type()
    {
        $this->signInAsAnAdmin();

        $data = Account::factory()->raw(['type' => 'aaa']);

        $this->post('/accounts', $data)->assertSessionHasErrors('type');

        $account = Account::factory()->create();
        $this->put('/accounts/' . $account->id, $data)->assertSessionHasErrors('type');
    }

    /** @test */
    public function an_unauthenticated_user_and_a_simple_user_cannot_create_an_account()
    {
        $this->get('/accounts/create')->assertStatus(403);
        $this->post('/accounts')->assertStatus(403);

        $this->signInAsASimpleUser();
        $this->get('/accounts/create')->assertStatus(403);
        $this->post('/accounts')->assertStatus(403);
    }

    /** @test */
    public function an_admin_can_create_an_account()
    {
        $this->signInAsAnAdmin();

        $data = Account::factory()->raw();
        $this->get('/accounts/create')->assertOk();
        $this->post('/accounts', $data);
        $this->assertDatabaseHas('accounts', $data);
    }

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
