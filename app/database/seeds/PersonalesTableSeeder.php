<?php

class PersonalesTableSeeder extends Seeder {

    public function run()
    {
        $personales = [
            [
                'id'   => '1',
                'name' => 'Claudio scheuermann',
                'slug' => 'claudio-scheuermann',
            ],
            [
                'id'   => '2',
                'name' => 'Luis Moncada',
                'slug' => 'luis-moncada',
            ],
            [
                'id'   => '3',
                'name' => 'Alfredo Jimenez',
                'slug' => 'alfredo-jimenez',
            ],
        ];

        DB::table('personales')->insert($personales);

        DB::table('personal_trick')->insert([
            [ 'personal_id' => '1', 'trick_id' => '5' ],
            [ 'personal_id' => '2', 'trick_id' => '6' ],
            [ 'personal_id' => '3', 'trick_id' => '7' ],
            
        ]);
    }
}
