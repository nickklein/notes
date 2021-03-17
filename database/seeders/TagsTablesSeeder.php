<?php

namespace Database\Seeders;

use notes\Models\Tags;
use notes\Models\TagsRel;
use Illuminate\Database\Seeder;

class TagsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tags::factory()->count(100)->create();
    }
}
