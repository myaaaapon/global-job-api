<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\Remote;

class RemoteSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $remotes = [
            'フルリモート',
            '週3回出社',
            '週2回出社',
            '月1回出社',
            '不定期出社',
            'その他',
        ];

        $remotesData = [];
        foreach ($remotes as $remote) {
            $remotesData[] = [
                'name' => $remote,
            ];
        }

        Remote::insert($remotesData);
    }
}
