<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use notes\Services\Notes\CreateNote;
use notes\Services\Notes\DestroyNote;
use notes\User;

class CreateTagTest extends TestCase
{
    CONST USER_ID = 1;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // Create a dummy note
        $createdId = (new CreateNote)->handle(self::USER_ID);
        // Grab testing account
        $user = User::find(self::USER_ID);

        // Start Unit Test
        $this->actingAs($user, 'api')
        ->json('POST', 'api/tags/create', ['page_id' => $createdId, 'tag_name' => 'TEST'])
        ->assertJson([
            'state' => 'success',
        ]);

        // Destroy dummy note
        (new DestroyNote)->handle(self::USER_ID, ['page_id' => $createdId]);
    }
}
