<?php

namespace App\Services;

use App\Exceptions\ProductNotFoundException;
use App\Models\Invoice;
use App\Models\Product;
use App\Traits\HttpResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    use HttpResponseTrait;
    public function printHello()
    {
        return "hello";
    }
    // foreach ($request->products as $productData) {
    //     $product = Product::find($productData['id']);

    //     $invoice->products()->attach($product->id, [
    //         'quantity' => $productData['quantity'],
    //         'unit_price' => $productData['unit_price'],
    //     ]);

    //     $product->decreaseQuantity($productData["quantity"]);
    // }
    // $productIds = [];

    // foreach ($request->products as $productData) {
    //     $productIds[] = $productData['id'];
    // }

    // $products = Product::find($productIds);

    // foreach ($products as $product) {
    //     $invoice->products()->attach($product->id, [
    //         'quantity' => $productData['quantity'],
    //         'unit_price' => $productData['unit_price'],
    //     ]);

    //     $product->decreaseQuantity($productData["quantity"]);
    // }
    // $productIds = collect($request->products)->pluck('id');
    // $products = Product::find($productIds);

    // foreach ($request->input('products') as $productData) {
    //     $invoice->products()->attach($productData["id"], [
    //         'quantity' => $productData['quantity'],
    //         'unit_price' => $productData['unit_price'],
    //     ]);

    //     Product::find($productData["id"])->decreaseQuantity($productData["quantity"]);
    // }
    public function createInvoiceWithProducts($request)
    {

        try {
            // $validatedData = $request->validated();
            $invoice = null;

            // dd($validatedData);
            // dd(Invoice::create([]));
            DB::transaction(function () use ($request) {
                $invoice = Invoice::create([
                    'invoice_number' => generateIdentifier("INV"),
                    'customer_id' => $request->input('customer_id'),
                    'total_amount' => $request->input('total_amount'),
                    'payment_due' => $request->input('payment_due'),
                    'subtotal_amount' => $request->input('subtotal_amount'),
                    'discount' => $request->input('discount'),
                    'tax' => $request->input('tax'),
                    'note' => $request->input('note'),
                    'currency' => $request->input('currency'),
                    'status' => $request->input('status')
                ]);
                // dd($invoice->invoice_number);
                // $invoice = new Invoice();
                // $invoice->invoice_number = generateIdentifier("INV");
                // $invoice->customer_id = $validatedData["customer_id"];
                // $invoice->total_amount = $validatedData["total_amount"];
                // $invoice->payment_due = $validatedData["payment_due"];
                // $invoice->subtotal_amount = $validatedData["subtotal_amount"];
                // $invoice->discount = $validatedData["discount"];
                // $invoice->tax = $validatedData["tax"];
                // $invoice->note = $validatedData["note"];
                // $invoice->currency = $validatedData["currency"];
                // $invoice->status = $validatedData["status"];
                // $invoice->save();
                foreach ($request->input('products') as $productData) {

                    // $product = $invoice->products()->find($productData['product_id']);
                    $product = Product::find($productData["product_id"]);

                    if (!$product) {
                        throw new ProductNotFoundException($productData["product_id"]);
                    }
                    $invoice->products()->attach($product, [
                        'quantity' => $productData['quantity'],
                        'unit_price' => $productData['unit_price']
                    ]);

                    if (!$product->inventory->decreaseQuantity($productData['quantity'])){
                        DB::rollBack();
                        throw new Exception("Product {$product->name}  is out of stock");
                    }
                }
                if ($invoice){
                     return [
                        "data" => $invoice
                    ];
                }
            });
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // what to return here
            if ($e instanceof ProductNotFoundException) {
                return [
                    "error" => "The product with the ID {$e->getProductId()} could not be found."
                ];
            }
            return [
                "error" => "Something went wrong while creating invoice {$e->getMessage()}"
            ];
            // return $this->serverError("Something went wrong while creating invoice");
        }
    }
}
