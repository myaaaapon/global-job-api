<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\Item;
use App\Domain\Entities\HtmlTag;
use App\Domain\Entities\Company;
use App\Domain\Entities\Category;
use App\Domain\Entities\ContractType;
use App\Domain\Entities\Remote;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();
        $htmlTags = HtmlTag::all();
        $companies = Company::all();
        $categories = Category::all();
        $contractTypes = ContractType::all();
        $remotes = Remote::all();

        $pricePatterns = ['30万円/月', '50万円/月', '80万円/月', '100万円/月', '150万円/月', '7,500,000円/年', '8,500,000円/年'];

        foreach (range(1, 20) as $index) {
            $htmlTag = $htmlTags->random();
            $company = $companies->random();
            $category = $categories->random();
            $contractType = $contractTypes->random();
            $remote = $remotes->random();
            $price = $faker->randomElement($pricePatterns);

            Item::create([
                'html_tag_id' => $htmlTag->id,
                'title' => "{$htmlTag->title} - {$category->name} - {$company->name}",
                'body' => "<html><body><h1>{$company->name}</h1><p>{$htmlTag->body}</p></body></html>",
                'company_id' => $company->id,
                'price' => $price,
                'category_id' => $category->id,
                'contract_type_id' => $contractType->id,
                'remote_id' => $remote->id,
                'published_at' => $faker->dateTimeThisYear('now', 'Asia/Tokyo'),
                'image_url' => $faker->imageUrl(),
                'score' => $faker->numberBetween(30, 70),
            ]);
        }
    }
}
