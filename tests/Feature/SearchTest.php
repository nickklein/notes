<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use notes\User;

class SearchTest extends TestCase
{
    CONST USER_ID = 1;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::find(self::USER_ID);

        $this->actingAs($user, 'api')
            ->json('GET', '/api/notes/feed/edxsd')
            ->assertStatus(200);
    }
}
