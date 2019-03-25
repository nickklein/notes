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
        $notes_insert = array();
        // Generate Notes
        factory(\App\Models\Notes::class, 500)->create();

        // Generate Notes Settings
        $settings = array(
            array('nsetting_name' => 'encryption'),
            array('nsetting_name' => 'starred'),
        );
        NotesSettings::insert($settings);

        //factory(\App\Models\NotesSettingsRel::class, 255)->create();
        $notes = Notes::inRandomOrder()->limit(50)->get();
        foreach($notes as $note) {
            $notes_insert[] = array(
                'note_id' => $note->note_id,
                'nsetting_id' => 2
            );
        }
        NotesSettingsRel::insert($notes_insert);
        // Generate Notes Settings Rel

    }
}
