<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Item;
use App\Models\Domain\Entities\Tag;
use App\Models\Domain\Entities\ItemTag;

class ItemTagSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $items = Item::all();
        $tags = Tag::all();

        $itemTags = [];
        foreach ($items as $item) {
            $randomTags = $tags->random(2);
            foreach ($randomTags as $tag) {
                $itemTags[] = [
                    'item_id' => $item->id,
                    'tag_id' => $tag->id,
                ];
            }
        }

        ItemTag::insert($itemTags);
    }
}
