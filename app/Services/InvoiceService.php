<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\Product;

class InvoiceService
{
    public function associateProducts($invoice, $request)
    {

        // foreach ($request->products as $productData) {
        //     $product = Product::find($productData['id']);

        //     $invoice->products()->attach($product->id, [
        //         'quantity' => $productData['quantity'],
        //         'unit_price' => $productData['unit_price'],
        //     ]);

        //     $product->decreaseQuantity($productData["quantity"]);
        // }
        $productIds = [];

        foreach ($request->products as $productData) {
            $productIds[] = $productData['id'];
        }

        $products = Product::find($productIds);

        foreach ($products as $product) {
            $invoice->products()->attach($product->id, [
                'quantity' => $productData['quantity'],
                'unit_price' => $productData['unit_price'],
            ]);

            $product->decreaseQuantity($productData["quantity"]);
        }
    }
}
