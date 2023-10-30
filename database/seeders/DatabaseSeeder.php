<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Coupon;
use App\Models\PurchaseOrder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'ahmed',
        //     'email' => 'hmedzubairu365@gmail.com',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',//password
        //     'email_verified_at' => now(),
        // ]);
        Coupon::factory(10)->create();
        $this->call(CustomerSeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(PurchaseOrderSeeder::class);
    }
}
