<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserStatus;

class UserStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserStatus::create(['name' => '管理者']);
        UserStatus::create(['name' => '無料ユーザー']);
        UserStatus::create(['name' => '有料ユーザー']);
    }
}
