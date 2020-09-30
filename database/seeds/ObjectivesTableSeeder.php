<?php

use Illuminate\Database\Seeder;

class ObjectiveTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('objectives')->insert([
            ['objective' => 'some perkara objective!' , 'created_by' => '1']
        ]);

    }
}
