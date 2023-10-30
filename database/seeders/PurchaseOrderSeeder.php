<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\PurchaseOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseOrder::factory()->count(20)->hasAttached(Product::factory()->count(4), ["quantity"=>rand(1, 100)])->create();
    }
}
