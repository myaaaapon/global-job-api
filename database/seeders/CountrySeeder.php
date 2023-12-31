<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\Country;

class CountrySeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
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
