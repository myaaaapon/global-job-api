<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain\Entities\Company;
use App\Models\Domain\Entities\Country;

class CompanySeeder extends Seeder
{
    /**
     * データベースのシーダーを実行します。
     *
     * @return void
     */
    public function run(): void
    {
        $countries = Country::inRandomOrder()->take(10)->get();

        $companyNames = ['ABC Corporation', 'XYZ Ltd', 'DEF Inc', 'GHI Group', 'JKL Technologies', 'MNO Trading', 'PQR Services', 'STU Co', 'VWX Holdings', 'YZA Enterprises'];
        $cities = ['New York', 'London', 'Tokyo', 'Paris', 'Berlin', 'Sydney', 'Toronto', 'Dubai', 'Singapore', 'Hong Kong'];

        $companiesData = [];
        foreach ($countries as $country) {
            $companiesData[] = [
                'country_id' => $country->id,
                'name' => $companyNames[array_rand($companyNames)],
                'address' => $cities[array_rand($cities)] . ', ' . $this->generateRandomAddress(),
            ];
        }

        Company::insert($companiesData);
    }

    /**
     * ランダムな住所を生成します。
     *
     * @return string
     */
    private function generateRandomAddress(): string
    {
        $districts = ['A District', 'B District', 'C District', 'D District', 'E District', 'F District', 'G District', 'H District', 'I District', 'J District'];
        $streets = range(1, 10);
        $blocks = range(1, 100);

        $randomDistrict = $districts[array_rand($districts)];
        $randomStreet = $streets[array_rand($streets)];
        $randomBlock = $blocks[array_rand($blocks)];

        return $randomDistrict . ' ' . $randomStreet . ' Street, Block ' . $randomBlock;
    }
}
