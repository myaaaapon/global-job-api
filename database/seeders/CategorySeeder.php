<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\Category;

class CategorySeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
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
