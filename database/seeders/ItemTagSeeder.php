<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Item;
use App\Models\Domain\Entities\HtmlTag;
use App\Models\Domain\Entities\ItemTag;

class ItemTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        $htmlTags = HtmlTag::all();

        $itemTags = [];
        foreach ($items as $item) {
            $randomTags = $htmlTags->random(2);
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
