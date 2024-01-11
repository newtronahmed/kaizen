<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\HttpResponseTrait;
use App\Services\InventoryService;
use App\Services\ProductService;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use HttpResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = Product::all();
            return $this->success("success", $products);
        } catch (Exception $exception) {
            return $this->badRequest($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, ProductService $productService)
    {
        try {
            // $product = Product::create($request->validated());
            // // $productService->
            // if ($product->inventory()->exists()) {
            //     $this->badRequest('Inventory already created');
            // }
            // $product->inventory()->create([
            //     'quantity' => $request->only('initial_quantity'),
            //     'minimum_stock_level' => $request->only('minimum_stock_level'),
            //     'maximum_stock_level' => $request->only('maximum_stock_level'),
            // ]);
            $data = $productService->createProduct($request);
            if (isset($data["error"])){
                $e = $data["error"];
                return $this->serverError('Something went wrong while creating product product- '.$e->getMessage());
            }
            //associat to inventory and set attributes
            //associate to brand
            if (isset($data["data"])){
                return $this->success('success', $data["data"]);
            }
            return $this->success("success", $data);
        } catch (Exception $exception) {
            return $this->badRequest($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try {
            // $products = Product::all();
            return $this->success("success", $product);
        } catch (Exception $exception) {
            return $this->badRequest($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, InventoryService $inventoryService, ProductService $productService)
    {
        try {
            $validatedData = $request->validated();
            // Begin transaction
            DB::beginTransaction();

            $productService->updateProduct($product, $validatedData);
            // $inventory = $product->inventory;
            $inventoryService->updateInventoryLevels(
                $product->id,
                $request->minimum_stock_level,
                $request->maximum_stock_level,
                $request->quantity
            );

            // Save product
            // $product->save();
            // Commit transaction if no errors
            DB::commit();
            // $inventory->minimum_stock_level = $validatedData["minimum_stock_level"];
            // $inventory->maximum_stock_level = $validatedData["maximum_stock_level"];
            // $inventory->quantity = $validatedData["quantity"];
            // $product->save();
            // $inventory->save();
        } catch (Exception $e) {
            DB::rollBack(); 
            return $this->serverError("Something went wrong while trying to create product");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $products = $product->delete();
            return $this->success("success", $products);
        } catch (Exception $exception) {
            return $this->badRequest($exception->getMessage());
        }
    }
}
