<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            '日本',
            'アメリカ合衆国',
            'カナダ',
            'イギリス',
            'ドイツ',
            'フランス',
            '中国',
            'オーストラリア',
            'ブラジル',
            'インド',
        ];

        $data = [];
        foreach ($countries as $country) {
            $data[] = [
                'name' => $country,
            ];
        }

        // データを一括で挿入
        Country::insert($data);
    }
}
