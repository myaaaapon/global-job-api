<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserStatusesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(TagSeeder::class);
        $this->call(UserTagSeeder::class);
    }
}
