<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use notes\User;

class CreateNoteTest extends TestCase
{
    CONST USER_ID = 1;

    /**
     * Creates a note, and checks for the response
     *
     * @return void
     */
    public function testBasicExample()
    {
        // Create dummy account
        $user = User::find(self::USER_ID);

        // Create a note
        $this->actingAs($user, 'api')
            ->json('POST', 'api/notes/create')
            ->assertJson([
                'success' => true,
            ]);

    }
}
