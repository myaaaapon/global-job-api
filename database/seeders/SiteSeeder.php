<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Site;

class SiteSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $sites = [
            [
                'name' => 'TechJobs',
                'home_url' => 'https://www.techjobs.com/',
            ],
            [
                'name' => 'JobHub',
                'home_url' => 'https://www.jobhub.com/',
            ],
            [
                'name' => 'CareerConnect',
                'home_url' => 'https://www.careerconnect.com/',
            ],
            [
                'name' => 'GlobalHire',
                'home_url' => 'https://www.globalhire.com/',
            ],
            [
                'name' => 'TopTalent',
                'home_url' => 'https://www.toptalent.com/',
            ],
        ];

        $sitesData = [];
        foreach ($sites as $site) {
            $sitesData[] = [
                'name' => $site['name'],
                'home_url' => $site['home_url'],
            ];
        }

        Site::insert($sitesData);
    }
}
