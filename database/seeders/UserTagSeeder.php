<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;

class UserTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $tags = Tag::whereIn('name', ['Nuxt.js', 'js'])->get();

        foreach ($users as $user) {
            foreach ($tags as $tag) {
                // Create UserTag relationship
                UserTag::create([
                    'user_id' => $user->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }
    }
}
