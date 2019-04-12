<?php

use notes\Models\Notes;
use notes\Models\NotesRel;
use notes\Models\NotesSettings;
use notes\Models\NotesSettingsRel;
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
        $note_rel = array();
        $settings = array(
            array('nsetting_name' => 'encryption'),
            array('nsetting_name' => 'starred'),
        );

        // Generate Notes
        factory(\notes\Models\Notes::class, 500)->create();

        for($i = 1; $i < 500; $i++) {
            $note_rel[] = array(
                'note_id' => $i,
                'user_id' => rand(0,50),
                'permission' => 'admin'
            );
        }
        NotesRel::insert($note_rel);

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

    }
}
