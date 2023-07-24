<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\User;
use App\Models\Domain\Entities\Tag;
use App\Models\Domain\Entities\UserTag;

class UserTagSeeder extends Seeder
{
    /**
     * データベースシーディングを実行します。
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
