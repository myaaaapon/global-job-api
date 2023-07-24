<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\HtmlTag;
use App\Models\Domain\Entities\Job;
use App\Models\Domain\Entities\Language;

class HtmlTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = Job::all();
        $languages = Language::all();

        foreach ($jobs as $job) {
            HtmlTag::create([
                'job_id' => $job->id,
                'title' => "{$job->title} HTML Tag",
                'body' => "<html><body><h1>{$job->title}</h1><p>{$job->content}</p></body></html>",
                'language_id' => $languages->random()->id,
            ]);
        }

    }
}
