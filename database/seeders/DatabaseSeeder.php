<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * アプリケーションのデータベースにシードを挿入します。
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserStatusesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(UserTagSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ContractTypeSeeder::class);
        $this->call(RemoteSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(JobSeeder::class);
        $this->call(HtmlTagSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ItemTagSeeder::class);
    }
}
