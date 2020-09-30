<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('asdasd'), 'created_at' => Carbon::now()],
            ['name' => 'Internal Auditor', 'email' => 'internalauditor@gmail.com', 'password' => bcrypt('asdasd'), 'created_at' => Carbon::now()],
            ['name' => 'Head of Quality & Auditor', 'email' => 'headofqualityandauditor@gmail.com', 'password' => bcrypt('asdasd'), 'created_at' => Carbon::now()]
        ]);

        DB::table('profiles')->insert([
            ['ic' => '95123698742']
        ]);

        Role::create(['name' => 'admin']);
        $users = User::where('name', 'admin')->get();

        foreach ($users as $user) {
            $user->assignRole('Admin');
        }


        Role::create(['name' => 'Internal Auditor']);
        $internals = User::where('name', 'admin')->get();

        foreach ($internals as $user) {
            $user->assignRole('Internal Auditor');
        }

        Role::create(['name' => 'Head of Quality & Auditor']);
        $heads = User::where('name', 'Head of Quality & Auditor')->get();

        foreach ($heads as $user) {
            $user->assignRole('Head of Quality & Auditor');
        }
    }
}
