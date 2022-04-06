<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signInAsASimpleUser()
    {
        $user = User::factory()->create(['isAdmin' => false]);
        $this->actingAs($user);
        return $user;
    }

    protected function signInAsAnAdmin()
    {
        $user = User::factory()->create(['isAdmin' => true]);
        $this->actingAs($user);
        return $user;
    }
}
