<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function createProduct(StoreProductRequest $request)
    {
        try {
            
            DB::transaction(function () use ($request){
                $product = Product::create(
                    [
                        'name' => $request->input('name'),
                        'color' => $request->input('color'),
                        'size' => $request->input('size'),
                        'unit' => $request->input('unit'),
                        'manufacturer' => $request->input('manufacturer'),
                        'product_type' => $request->input('product_type'),
                        'cost_price' => $request->input('cost_price'),
                        'selling_price' => $request->input('selling_price'),
                        'returnable' => $request->input('returnable'),
                        'brand_id' => $request->input('brand_id')
                    ]
                );
        
                if ($product->inventory()->exists()) {
                    throw new Exception("Product already exists in inventory");
                }
        
                $product->inventory()->create([
                    'quantity' => $request->input('initial_quantity'),
                    'minimum_stock_level' => $request->input('minimum_stock_level'),
                    'maximum_stock_level' => $request->input('maximum_stock_level'),
                ]);
                
                // associate to inventory and set attributes
                // associate to brand
        
                return ['data' => $product];
    
            });
        } catch (Exception $e) {
            DB::rollBack();
            return ['error' => $e];
        }
    }
    public function updateProduct($product,  $data)
    {
        try {
            //code...
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
        } catch (Exception $e) {
            return [
                "error" => "Something went wrong while updating product"
            ];
        }
    }
}
