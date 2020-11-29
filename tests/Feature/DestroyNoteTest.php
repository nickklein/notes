<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use notes\User;
use notes\Services\Notes\CreateNote;

class DestroyNoteTest extends TestCase
{
    CONST USER_ID = 1;
    /**
     * Delete Note
     *
     * @return void
     */
    public function testBasicExample()
    {
        // Create a dummy note
        $createdId = (new CreateNote)->handle(self::USER_ID);
        // Grab testing account
        $user = User::find(self::USER_ID);

        $this->actingAs($user, 'api')
            ->json('POST', '/api/notes/remove', ['page_id' => $createdId])
            ->assertJson([
                'success' => true,
            ]);
    }
}
