<?php
namespace App\Services;
use App\Models\Inventory;

class InventoryService
{

    /**
     * Update the inventory levels for a product.
     * 
     * @param int $productId The ID of the product to update
     * @param int $minLevel The minimum stock level to set
     * @param int $maxLevel The maximum stock level to set  
     * @param int $quantity The current stock quantity to set
     *
     * @return void
     */
    public function updateInventoryLevels($productId, $minLevel, $maxLevel, $quantity)
    {

        // Fetch inventory for product
        $inventory = Inventory::where('product_id', $productId)->first();

        // Update inventory levels
        $inventory->minimum_stock_level = $minLevel;
        $inventory->maximum_stock_level = $maxLevel;
        $inventory->quantity = $quantity;

        // Save inventory 
        $inventory->save();
    }
}
