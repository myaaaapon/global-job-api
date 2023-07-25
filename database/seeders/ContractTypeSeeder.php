<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\ContractType;

class ContractTypeSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $contractTypes = [
            '業務委託',
            '正社員',
            '契約社員',
            'パート・アルバイト',
            'インターン',
            'フリーランス',
            'その他',
        ];

        $contractTypesData = [];

        foreach ($contractTypes as $type) {
            $contractTypesData[] = [
                'name' => $type,
            ];
        }

        ContractType::insert($contractTypesData);
    }
}
