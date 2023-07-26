<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\Job;
use App\Domain\Entities\Site;

class JobSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $sites = Site::inRandomOrder()->take(2)->get();
        $jobsData = [];

        for ($i = 1; $i <= 10; $i++) {
            foreach ($sites as $site) {
                $jobsData[] = [
                    'site_id' => $site->id,
                    'url' => "https://www.{$site->name}.com/job{$i}",
                    'content' => "<html><body><h1>{$site->name} Job {$i} content</h1></body></html>",
                ];
            }
        }

        Job::insert($jobsData);
    }
}
