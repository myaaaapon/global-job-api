<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Company;
use App\Models\Domain\Entities\Country;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = Country::inRandomOrder()->take(10)->get();

        $companiesData = [];
        foreach ($countries as $index => $country) {
            $companiesData[] = [
                'country_id' => $country->id,
                'name' => '会社名' . ($index + 1),
                'address' => '住所' . ($index + 1),
            ];
        }

        Company::insert($companiesData);
    }
}
