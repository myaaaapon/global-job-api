<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'フロントエンドエンジニア',
            'バックエンドエンジニア',
            'フルスタックエンジニア',
            'モバイルアプリエンジニア',
            'データベースエンジニア',
            'クラウドエンジニア',
            'セキュリティエンジニア',
            'DevOpsエンジニア',
            'AI・機械学習エンジニア',
            'その他',
        ];

        $categoriesData = [];
        foreach ($categories as $category) {
            $categoriesData[] = [
                'name' => $category,
            ];
        }

        Category::insert($categoriesData);
    }
}
