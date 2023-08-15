<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Producer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Company::factory()
            ->count(20)
            ->has(Product::factory()
                    ->count(5)
                    ->has(Producer::factory()
                            ->count(5)
                    )
            )
            ->create();
    }
}
