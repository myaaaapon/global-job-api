<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = [
            [
                'name' => 'Upwork',
                'home_url' => 'https://www.upwork.com/',
            ],
            [
                'name' => 'Freelancer',
                'home_url' => 'https://www.freelancer.com/',
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
