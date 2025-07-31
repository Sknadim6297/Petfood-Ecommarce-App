<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            [
                'name' => 'Royal Canin',
                'slug' => 'royal-canin',
                'meta_description' => 'Premium pet food brand focusing on breed-specific nutrition',
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Pedigree',
                'slug' => 'pedigree',
                'meta_description' => 'Complete nutrition for dogs of all ages',
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Whiskas',
                'slug' => 'whiskas',
                'meta_description' => 'Delicious and nutritious cat food',
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Purina',
                'slug' => 'purina',
                'meta_description' => 'Nutrition that performs for pets',
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Hills Science Diet',
                'slug' => 'hills-science-diet',
                'meta_description' => 'Clinically proven nutrition for pets',
                'status' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(['slug' => $brand['slug']], $brand);
        }
    }
}
