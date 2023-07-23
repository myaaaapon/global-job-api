<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\User;
use App\Models\Domain\Entities\UserStatus;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * データベースシーディングを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'name' => '山田 太郎',
                'email' => 'taro@example.com',
                'password' => Hash::make('password'),
                'status_id' => UserStatus::FREE_USER,
            ],
            [
                'name' => '佐藤 花子',
                'email' => 'hanako@example.com',
                'password' => Hash::make('password'),
                'status_id' => UserStatus::PAID_USER,
            ],
            [
                'name' => '鈴木 次郎',
                'email' => 'jiro@example.com',
                'password' => Hash::make('password'),
                'status_id' => UserStatus::FREE_USER,
            ],
        ];

        User::insert($users);
    }
}
