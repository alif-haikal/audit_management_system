<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('activities')->insert([
            ['perkara' => 'some perkara content!', 'perancangan' => Carbon::parse('30-12-2020') , 'created_by' => '1']
        ]);

    }
}
