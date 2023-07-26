<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\UserStatus;

class UserStatusesTableSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        UserStatus::insert([
            ['name' => '管理者'],
            ['name' => '無料ユーザー'],
            ['name' => '有料ユーザー'],
        ]);
    }
}
