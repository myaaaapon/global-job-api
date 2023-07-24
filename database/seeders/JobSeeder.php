<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Job;
use App\Models\Domain\Entities\Site;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = Site::all();

        foreach ($sites as $site) {
            Job::create([
                'site_id' => $site->id,
                'url' => "https://www.{$site->name}.com/job",
                'content' => "<html><body><h1>{$site->name} Job content</h1></body></html>",
            ]);
        }
    }
}
