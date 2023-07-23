<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * アプリケーションのデータベースにシードを挿入します。
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserStatusesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(UserTagSeeder::class);
    }
}
