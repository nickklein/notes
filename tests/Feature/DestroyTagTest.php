<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use notes\Services\Notes\CreateNote;
use notes\Services\Tags\CreateTag;
use notes\User;

class DestroyTagTest extends TestCase
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
        // Create dummy tag
        $tagInfo = (new CreateTag)->handle(self::USER_ID, ['tag_name' => 'TEST', 'page_id' => $createdId]);

        // Destroy Tag Test
        $this->actingAs($user, 'api')
        ->json('POST', 'api/tags/remove', ['page_id' => $createdId, 'tag_name' => 'TEST'])
        ->assertJson([
            'state' => 'success',
        ]);
    }
}
