<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\User;
use App\Domain\Entities\Tag;
use App\Domain\Entities\UserTag;

class UserTagSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::all();
        $existingTags = Tag::all();

        foreach ($users as $user) {
            // タグをランダムに選択します
            $randomTags = $existingTags->random(rand(2, 3));

            // ユーザーにタグを追加します
            foreach ($randomTags as $tag) {
                UserTag::create([
                    'user_id' => $user->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }
    }
}
