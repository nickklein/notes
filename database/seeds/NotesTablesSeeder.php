<?php

use App\Models\Notes;
use App\Models\NotesSettings;
use App\Models\NotesSettingsRel;
use Illuminate\Database\Seeder;

class NotesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate Notes
        factory(\App\Models\Notes::class, 500)->create();

        // Generate Notes Settings
        $settings = array(
            array('nsetting_name' => 'encryption'),
            array('nsetting_name' => 'starred'),
        );
        NotesSettings::insert($settings);

        //factory(\App\Models\NotesSettingsRel::class, 255)->create();
        // Generate Notes Settings Rel

    }
}
