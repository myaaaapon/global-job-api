<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Entities\HtmlTag;
use App\Domain\Entities\Job;
use App\Domain\Entities\Language;

class HtmlTagSeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $jobs = Job::inRandomOrder()->take(20)->get();
        $languages = Language::all();
        $htmlTagsData = [];

        foreach ($jobs as $job) {
            $language = $languages->random();
            $htmlTagsData[] = [
                'job_id' => $job->id,
                'title' => "{$job->title} Explore Career",
                'body' => "<html><body><h1>{$job->title}</h1><p>{$job->content}</p></body></html>",
                'language_id' => $language->id,
            ];
        }

        HtmlTag::insert($htmlTagsData);
    }
}
