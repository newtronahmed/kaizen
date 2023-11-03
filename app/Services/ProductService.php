<?php
namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function updateProduct(Product $product,  $data)
    {
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->selling_price = $data['selling_price'];
        $product->color = $data['color'];
        $product->size = $data['size'];
        $product->unit = $data['unit'];
        $product->manufacturer = $data['manufacturer'];
        $product->product_type = $data['product_type'];
        $product->cost_price = $data['cost_price'];
        $product->returnable = $data['returnable'];
        $product->brand_id = $data['brand_id'];

        $product->save();

        return $product;
    }
}