<?php

use Illuminate\Database\Seeder;

class ProcessTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('process')->insert([
            ['process' => 'some process process!' , 'created_by' => '1']
        ]);

    }
}
