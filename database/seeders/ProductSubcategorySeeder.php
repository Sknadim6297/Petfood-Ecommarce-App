<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class ProductSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories and subcategories
        $dogCategory = Category::where('slug', 'dog')->first();
        $catCategory = Category::where('slug', 'cat')->first();
        
        // Get some brands (create if they don't exist)
        $brands = [];
        $brandNames = ['Royal Canin', 'Hill\'s', 'Purina', 'Whiskas', 'Pedigree'];
        
        foreach ($brandNames as $brandName) {
            $brand = Brand::firstOrCreate(
                ['name' => $brandName],
                [
                    'slug' => Str::slug($brandName),
                    'status' => true
                ]
            );
            $brands[] = $brand;
        }

        // Sample products for Dog subcategories
        $dogProducts = [
            'Dog Food' => [
                [
                    'name' => 'Premium Adult Dog Food - Chicken & Rice',
                    'description' => 'High-quality adult dog food made with real chicken and brown rice. Provides complete and balanced nutrition for adult dogs.',
                    'short_description' => 'Premium chicken & rice formula for adult dogs',
                    'price' => 45.99,
                    'sale_price' => 39.99,
                    'sku' => 'DOG-FOOD-001',
                    'stock_quantity' => 50
                ],
                [
                    'name' => 'Puppy Growth Formula - Lamb & Sweet Potato',
                    'description' => 'Specially formulated for growing puppies with lamb protein and sweet potato for easy digestion.',
                    'short_description' => 'Growth formula for puppies',
                    'price' => 52.99,
                    'sale_price' => 47.99,
                    'sku' => 'DOG-FOOD-002',
                    'stock_quantity' => 35
                ]
            ],
            'Dog Accessories' => [
                [
                    'name' => 'Adjustable Dog Collar - Medium',
                    'description' => 'Durable nylon collar with quick-release buckle. Adjustable from 14-20 inches.',
                    'short_description' => 'Adjustable nylon dog collar',
                    'price' => 15.99,
                    'sku' => 'DOG-ACC-001',
                    'stock_quantity' => 25
                ],
                [
                    'name' => 'Retractable Dog Leash - 16ft',
                    'description' => 'Heavy-duty retractable leash with comfortable grip handle. Suitable for dogs up to 110 lbs.',
                    'short_description' => '16ft retractable dog leash',
                    'price' => 29.99,
                    'sale_price' => 24.99,
                    'sku' => 'DOG-ACC-002',
                    'stock_quantity' => 40
                ]
            ],
            'Dog Supplements' => [
                [
                    'name' => 'Joint Health Supplement for Dogs',
                    'description' => 'Glucosamine and chondroitin supplement to support joint health and mobility in dogs.',
                    'short_description' => 'Joint health supplement',
                    'price' => 34.99,
                    'sku' => 'DOG-SUP-001',
                    'stock_quantity' => 30
                ]
            ]
        ];

        // Sample products for Cat subcategories
        $catProducts = [
            'Cat Food' => [
                [
                    'name' => 'Indoor Cat Formula - Salmon & Tuna',
                    'description' => 'Specially formulated for indoor cats with salmon and tuna. Helps maintain healthy weight.',
                    'short_description' => 'Indoor cat formula with fish',
                    'price' => 42.99,
                    'sale_price' => 37.99,
                    'sku' => 'CAT-FOOD-001',
                    'stock_quantity' => 45
                ],
                [
                    'name' => 'Kitten Growth Formula - Chicken',
                    'description' => 'Nutrient-rich formula designed for growing kittens with real chicken protein.',
                    'short_description' => 'Kitten growth formula',
                    'price' => 38.99,
                    'sku' => 'CAT-FOOD-002',
                    'stock_quantity' => 32
                ]
            ],
            'Cat Accessories' => [
                [
                    'name' => 'Self-Cleaning Cat Litter Box',
                    'description' => 'Automatic self-cleaning litter box with waste disposal system.',
                    'short_description' => 'Self-cleaning litter box',
                    'price' => 199.99,
                    'sale_price' => 159.99,
                    'sku' => 'CAT-ACC-001',
                    'stock_quantity' => 15
                ],
                [
                    'name' => 'Interactive Cat Toy Set',
                    'description' => 'Set of 5 interactive toys to keep your cat entertained and active.',
                    'short_description' => 'Interactive toy set',
                    'price' => 24.99,
                    'sku' => 'CAT-ACC-002',
                    'stock_quantity' => 60
                ]
            ]
        ];

        // Create Dog products
        foreach ($dogProducts as $subcategoryName => $products) {
            $subcategory = Category::where('name', $subcategoryName)->where('parent_id', $dogCategory->id)->first();
            
            if ($subcategory) {
                foreach ($products as $productData) {
                    $productData['slug'] = Str::slug($productData['name']);
                    $productData['category_id'] = $dogCategory->id;
                    $productData['subcategory_id'] = $subcategory->id;
                    $productData['brand_id'] = $brands[array_rand($brands)]->id;
                    $productData['is_active'] = true;
                    $productData['is_featured'] = rand(0, 1);
                    $productData['weight'] = rand(1, 20);
                    $productData['image'] = 'assets/img/products/placeholder.jpg';
                    
                    Product::create($productData);
                }
            }
        }

        // Create Cat products
        foreach ($catProducts as $subcategoryName => $products) {
            $subcategory = Category::where('name', $subcategoryName)->where('parent_id', $catCategory->id)->first();
            
            if ($subcategory) {
                foreach ($products as $productData) {
                    $productData['slug'] = Str::slug($productData['name']);
                    $productData['category_id'] = $catCategory->id;
                    $productData['subcategory_id'] = $subcategory->id;
                    $productData['brand_id'] = $brands[array_rand($brands)]->id;
                    $productData['is_active'] = true;
                    $productData['is_featured'] = rand(0, 1);
                    $productData['weight'] = rand(1, 15);
                    $productData['image'] = 'assets/img/products/placeholder.jpg';
                    
                    Product::create($productData);
                }
            }
        }

        $this->command->info('Products with subcategories seeded successfully!');
    }
}
