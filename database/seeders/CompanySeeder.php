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
            ->count(10)
            ->has(Product::factory()
                ->count(5)
                ->has(Producer::factory()
                    ->count(3))
            )
            ->create();
        
        Producer::all()->each(function ($producer) {
            $products = Product::inRandomOrder()->limit(3)->get();
            $producer->products()->attach($products);
        });
    }
}
