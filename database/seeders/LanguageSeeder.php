<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            '日本語',
            '英語',
            '中国語',
            'スペイン語',
            'フランス語',
            'ドイツ語',
            'イタリア語',
            'ロシア語',
            '韓国語',
            'その他',
        ];

        $languagesData = [];
        foreach ($languages as $language) {
            $languagesData[] = [
                'name' => $language,
            ];
        }

        Language::insert($languagesData);
    }
}
