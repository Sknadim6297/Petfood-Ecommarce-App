<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Clear existing products
        Product::truncate();

        // Get categories
        $dogFood = Category::where('slug', 'dog-food')->first();
        $animalFeed = Category::where('slug', 'animal-feed')->first();
        $catToys = Category::where('slug', 'cat-toys')->first();

        $products = [
            // Dog Food Products (10 products, 6 healthy)
            [
                'name' => 'Premium Healthy Dog Food - Chicken & Rice',
                'slug' => 'premium-healthy-dog-food-chicken-rice',
                'short_description' => 'Organic high-quality dog food with real chicken and rice',
                'description' => 'This premium organic dog food is made with real chicken as the first ingredient, combined with wholesome rice for easy digestion.',
                'price' => 1200.00,
                'sale_price' => 999.00,
                'sku' => 'PDF-CR-001',
                'stock_quantity' => 50,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => true,
                'is_healthy' => true,
                'is_deal_of_week' => true,
                'rating' => 4.8,
                'reviews_count' => 45
            ],
            [
                'name' => 'Organic Puppy Growth Formula',
                'slug' => 'organic-puppy-growth-formula',
                'short_description' => 'Natural and healthy nutrition for growing puppies',
                'description' => 'Complete organic nutrition for puppies up to 12 months. Contains DHA for brain development.',
                'price' => 850.00,
                'sku' => 'PGF-001',
                'stock_quantity' => 35,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => true,
                'is_healthy' => true,
                'rating' => 4.7,
                'reviews_count' => 32
            ],
            [
                'name' => 'Natural Adult Dog Food - Lamb & Vegetables',
                'slug' => 'natural-adult-dog-food-lamb-vegetables',
                'short_description' => 'Healthy lamb-based dog food with fresh vegetables',
                'description' => 'Premium natural dog food featuring real lamb and garden vegetables.',
                'price' => 1100.00,
                'sale_price' => 950.00,
                'sku' => 'ADF-LV-001',
                'stock_quantity' => 40,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => true,
                'rating' => 4.6,
                'reviews_count' => 28
            ],
            [
                'name' => 'Healthy Senior Dog Food',
                'slug' => 'healthy-senior-dog-food',
                'short_description' => 'Specially formulated for senior dogs with joint support',
                'description' => 'Nutritious food designed for dogs 7+ years with glucosamine for joint health.',
                'price' => 1300.00,
                'sku' => 'SDF-001',
                'stock_quantity' => 25,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => true,
                'rating' => 4.5,
                'reviews_count' => 19
            ],
            [
                'name' => 'Grain-Free Healthy Dog Food',
                'slug' => 'grain-free-healthy-dog-food',
                'short_description' => 'Healthy grain-free formula for sensitive stomachs',
                'description' => 'Premium grain-free dog food made with real meat and vegetables.',
                'price' => 1400.00,
                'sale_price' => 1200.00,
                'sku' => 'GDF-001',
                'stock_quantity' => 30,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => true,
                'is_healthy' => true,
                'rating' => 4.9,
                'reviews_count' => 52
            ],
            [
                'name' => 'Organic Weight Management Dog Food',
                'slug' => 'organic-weight-management-dog-food',
                'short_description' => 'Healthy low-calorie formula for weight control',
                'description' => 'Specially formulated organic dog food for weight management.',
                'price' => 1250.00,
                'sku' => 'WMF-001',
                'stock_quantity' => 20,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => true,
                'rating' => 4.4,
                'reviews_count' => 15
            ],
            [
                'name' => 'Economy Dog Food - Beef Flavor',
                'slug' => 'economy-dog-food-beef-flavor',
                'short_description' => 'Affordable beef flavored dog food',
                'description' => 'Budget-friendly dog food with beef flavor. Provides basic nutrition.',
                'price' => 650.00,
                'sku' => 'EDF-BF-001',
                'stock_quantity' => 60,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 3.8,
                'reviews_count' => 12
            ],
            [
                'name' => 'Standard Adult Dog Kibble',
                'slug' => 'standard-adult-dog-kibble',
                'short_description' => 'Regular adult dog food formula',
                'description' => 'Standard formula dry dog food for adult dogs.',
                'price' => 750.00,
                'sku' => 'SDK-001',
                'stock_quantity' => 45,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 4.0,
                'reviews_count' => 8
            ],
            [
                'name' => 'Basic Puppy Food',
                'slug' => 'basic-puppy-food',
                'short_description' => 'Basic nutrition for growing puppies',
                'description' => 'Essential nutrition for puppies with basic ingredients.',
                'price' => 600.00,
                'sku' => 'BPF-001',
                'stock_quantity' => 35,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 3.9,
                'reviews_count' => 6
            ],
            [
                'name' => 'Regular Adult Dog Food Mix',
                'slug' => 'regular-adult-dog-food-mix',
                'short_description' => 'Mixed formula for adult dogs',
                'description' => 'Standard mixed formula dog food with chicken and vegetables.',
                'price' => 800.00,
                'sale_price' => 720.00,
                'sku' => 'RDF-001',
                'stock_quantity' => 40,
                'category_id' => $dogFood->id ?? 1,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 4.1,
                'reviews_count' => 11
            ],
            // Animal Feed Products (5 products, 2 healthy)
            [
                'name' => 'Organic Rabbit Pellets',
                'slug' => 'organic-rabbit-pellets',
                'short_description' => 'Premium organic pellets for rabbits',
                'description' => 'High-fiber, organic pellets made from timothy hay and alfalfa.',
                'price' => 450.00,
                'sale_price' => 399.00,
                'sku' => 'ORP-001',
                'stock_quantity' => 45,
                'category_id' => $animalFeed->id ?? 2,
                'is_active' => true,
                'is_featured' => true,
                'is_healthy' => true,
                'rating' => 4.3,
                'reviews_count' => 12
            ],
            [
                'name' => 'Premium Healthy Bird Seed Mix',
                'slug' => 'premium-healthy-bird-seed-mix',
                'short_description' => 'Nutritious organic seed mix for all bird types',
                'description' => 'A carefully selected blend of organic sunflower seeds, millet, and safflower seeds.',
                'price' => 380.00,
                'sku' => 'PBS-001',
                'stock_quantity' => 60,
                'category_id' => $animalFeed->id ?? 2,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => true,
                'rating' => 4.4,
                'reviews_count' => 8
            ],
            [
                'name' => 'Standard Horse Feed',
                'slug' => 'standard-horse-feed',
                'short_description' => 'Complete nutrition for horses',
                'description' => 'Balanced horse feed with essential vitamins and minerals.',
                'price' => 2200.00,
                'sku' => 'SHF-001',
                'stock_quantity' => 15,
                'category_id' => $animalFeed->id ?? 2,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 4.2,
                'reviews_count' => 5
            ],
            [
                'name' => 'Chicken Layer Feed',
                'slug' => 'chicken-layer-feed',
                'short_description' => 'Specialized feed for laying hens',
                'description' => 'Complete feed for laying hens with calcium for strong eggshells.',
                'price' => 850.00,
                'sku' => 'CLF-001',
                'stock_quantity' => 30,
                'category_id' => $animalFeed->id ?? 2,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 4.0,
                'reviews_count' => 7
            ],
            [
                'name' => 'Goat Feed Pellets',
                'slug' => 'goat-feed-pellets',
                'short_description' => 'Nutritious pellets for goats',
                'description' => 'Complete nutrition pellets designed specifically for goats.',
                'price' => 950.00,
                'sku' => 'GFP-001',
                'stock_quantity' => 25,
                'category_id' => $animalFeed->id ?? 2,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 4.1,
                'reviews_count' => 4
            ],
            // Cat Toys Products (5 products, 1 healthy)
            [
                'name' => 'Organic Catnip Interactive Toy',
                'slug' => 'organic-catnip-interactive-toy',
                'short_description' => 'Natural organic catnip toy for cats',
                'description' => 'Made with organic catnip and natural materials, safe for your cat.',
                'price' => 320.00,
                'sale_price' => 250.00,
                'sku' => 'OCIT-001',
                'stock_quantity' => 75,
                'category_id' => $catToys->id ?? 3,
                'is_active' => true,
                'is_featured' => true,
                'is_healthy' => true,
                'rating' => 4.8,
                'reviews_count' => 42
            ],
            [
                'name' => 'Feather Wand Cat Toy',
                'slug' => 'feather-wand-cat-toy',
                'short_description' => 'Interactive feather toy for cats',
                'description' => 'Engaging feather toy that stimulates hunting instincts.',
                'price' => 180.00,
                'sku' => 'FWT-001',
                'stock_quantity' => 90,
                'category_id' => $catToys->id ?? 3,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 4.2,
                'reviews_count' => 16
            ],
            [
                'name' => 'Cat Laser Pointer',
                'slug' => 'cat-laser-pointer',
                'short_description' => 'Safe laser pointer for cat exercise',
                'description' => 'Safe laser pointer designed for cat exercise and play.',
                'price' => 250.00,
                'sku' => 'CLP-001',
                'stock_quantity' => 40,
                'category_id' => $catToys->id ?? 3,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 4.5,
                'reviews_count' => 23
            ],
            [
                'name' => 'Cat Scratching Post',
                'slug' => 'cat-scratching-post',
                'short_description' => 'Durable scratching post for cats',
                'description' => 'Tall scratching post covered in sisal rope for claw maintenance.',
                'price' => 1200.00,
                'sku' => 'CSP-001',
                'stock_quantity' => 20,
                'category_id' => $catToys->id ?? 3,
                'is_active' => true,
                'is_featured' => true,
                'is_healthy' => false,
                'rating' => 4.6,
                'reviews_count' => 31
            ],
            [
                'name' => 'Cat Ball Set',
                'slug' => 'cat-ball-set',
                'short_description' => 'Set of colorful play balls for cats',
                'description' => 'Set of 6 colorful balls with different textures for cat entertainment.',
                'price' => 150.00,
                'sku' => 'CBS-001',
                'stock_quantity' => 80,
                'category_id' => $catToys->id ?? 3,
                'is_active' => true,
                'is_featured' => false,
                'is_healthy' => false,
                'rating' => 3.9,
                'reviews_count' => 14
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
