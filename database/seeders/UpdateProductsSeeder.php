<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class UpdateProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update some products to be healthy
        Product::whereIn('id', [1, 2, 3, 4, 5, 6, 7, 8])
            ->update(['is_healthy' => true]);

        // Set one product as deal of the week
        $dealProduct = Product::where('sale_price', '>', 0)->first();
        if ($dealProduct) {
            $dealProduct->update(['is_deal_of_week' => true]);
        }

        $this->command->info('Products updated with healthy and deal of week flags!');
    }
}
