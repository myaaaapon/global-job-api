<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Tag;

class TagSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Nuxt.js'],
            ['name' => 'js'],
            ['name' => 'Go'],
            ['name' => 'React'],
            ['name' => 'Python'],
            ['name' => 'Java'],
            ['name' => 'PHP'],
            ['name' => 'Ruby'],
            ['name' => 'C#'],
            ['name' => 'Swift'],
        ];

        Tag::insert($tags);
    }
}
