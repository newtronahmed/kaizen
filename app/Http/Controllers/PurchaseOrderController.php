<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotFoundException;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Traits\HttpResponseTrait;
use Exception;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
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
            $orders = PurchaseOrder::all();
            return $this->success("success", $orders);
        } catch (Exception $exception) {
            return $this->badRequest($exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseOrderRequest $request)
    {
        //store purchase
        //associate products
        try {
            $order = PurchaseOrder::create($request->validated());
            foreach ($order->input('items') as $item) {
                $product = Product::find($item);
                if (!$product){
                    throw new ProductNotFoundException($item['product_id']);
                }
                $order->products()->attach($product, ['quantity' => $item['quantity']]);

            }
        } catch (Exception $e) {
            if($e instanceof ProductNotFoundException){
                return $this->notFound("Product with id of {$e->getProductId()} not found");
            }
            return $this->serverError('Something went wrong while creating order');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
