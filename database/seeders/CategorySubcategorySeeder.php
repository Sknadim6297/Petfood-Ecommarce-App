<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing categories (disable foreign key checks)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Main Categories with Subcategories
        $categoriesData = [
            'Dog' => [
                'description' => 'Products for dogs of all breeds and sizes',
                'image' => 'assets/img/categories/dog.jpg',
                'subcategories' => [
                    'Dog Food' => 'Nutritious food options for dogs',
                    'Dog Accessories' => 'Collars, leashes, toys and other accessories',
                    'Dog Supplements' => 'Health supplements and vitamins for dogs',
                    'Dog Treats' => 'Delicious treats and snacks for dogs',
                    'Dog Grooming' => 'Grooming products and tools for dogs'
                ]
            ],
            'Cat' => [
                'description' => 'Products for cats of all breeds and ages',
                'image' => 'assets/img/categories/cat.jpg',
                'subcategories' => [
                    'Cat Food' => 'Premium food options for cats',
                    'Cat Accessories' => 'Carriers, beds, toys and other accessories',
                    'Cat Supplements' => 'Health supplements and vitamins for cats',
                    'Cat Treats' => 'Tasty treats and snacks for cats',
                    'Cat Litter' => 'Various types of cat litter and accessories'
                ]
            ],
            'Bird' => [
                'description' => 'Products for birds and avian pets',
                'image' => 'assets/img/categories/bird.jpg',
                'subcategories' => [
                    'Bird Food' => 'Seeds, pellets and specialized bird food',
                    'Bird Accessories' => 'Cages, perches, toys and accessories',
                    'Bird Supplements' => 'Health supplements for birds',
                    'Bird Treats' => 'Nutritious treats for birds'
                ]
            ],
            'Fish & Aquarium' => [
                'description' => 'Products for fish and aquarium maintenance',
                'image' => 'assets/img/categories/fish.jpg',
                'subcategories' => [
                    'Fish Food' => 'Various types of fish food and nutrition',
                    'Aquarium Accessories' => 'Tanks, filters, decorations and equipment',
                    'Water Treatment' => 'Water conditioners and treatments',
                    'Aquarium Plants' => 'Live and artificial aquarium plants'
                ]
            ],
            'Small Animals' => [
                'description' => 'Products for rabbits, hamsters, guinea pigs and other small pets',
                'image' => 'assets/img/categories/small-animals.jpg',
                'subcategories' => [
                    'Small Animal Food' => 'Food for rabbits, hamsters, guinea pigs',
                    'Small Animal Accessories' => 'Cages, bedding, toys and accessories',
                    'Small Animal Supplements' => 'Health supplements for small animals',
                    'Small Animal Treats' => 'Healthy treats for small pets'
                ]
            ]
        ];

        foreach ($categoriesData as $categoryName => $categoryData) {
            // Create main category
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => $categoryData['description'],
                'image' => $categoryData['image'],
                'is_active' => true,
                'sort_order' => 0,
                'parent_id' => null
            ]);

            // Create subcategories
            $sortOrder = 1;
            foreach ($categoryData['subcategories'] as $subcategoryName => $subcategoryDescription) {
                Category::create([
                    'name' => $subcategoryName,
                    'slug' => Str::slug($subcategoryName),
                    'description' => $subcategoryDescription,
                    'image' => null,
                    'is_active' => true,
                    'sort_order' => $sortOrder++,
                    'parent_id' => $category->id
                ]);
            }
        }

        $this->command->info('Categories and subcategories seeded successfully!');
    }
}
