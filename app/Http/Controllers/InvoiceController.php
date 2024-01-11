<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotFoundException;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Services\InvoiceService;
use App\Traits\HttpResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class InvoiceController extends Controller
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
            $invoices = Invoice::all();

            // return response()->json(["data" => $invoices]);
            return $this->success('', $invoices);
        } catch (Exception $e) {
            return $this->serverError("Something went wrong while fetching invoices");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request, InvoiceService $invoiceService)
    {
        $validatedData = $request->validated();
        // dd($invoiceServ ice->printHello());
        $data = $invoiceService->createInvoiceWithProducts($request);
        if(isset($data["data"])) {
            return $this->success('Successfully created invoice', $data["data"]);
        }
        dd($data);
        return $this->serverError($data["error"]);
        // dd($data);
    }

    // public function store(StoreInvoiceRequest $request, InvoiceService $invoiceService)
    // {
    //     $validatedData = $request->validated();
    //     // dd($invoiceServ ice->printHello());
    //     try {
    //         // $validatedData = $request->validated();
    //         // $invoice = null;
    //         // dd($validatedData);

    //         // DB::transaction(function () use ($validatedData) {
    //         $invoice = Invoice::create([
    //             'invoice_number' => generateIdentifier("INV"),
    //             'customer_id' => $validatedData["customer_id"],
    //             'total_amount' => $validatedData["total_amount"],
    //             'payment_due' => $validatedData["payment_due"],
    //             // 'subtotal_amount' => $validatedData["subtotal_amount"],
    //             // 'discount' => $validatedData["discount"],
    //             // 'tax' => $validatedData["tax"],
    //             // 'note' => $validatedData["note"],
    //             // 'currency' => $validatedData["currency"],
    //             // 'status' => $validatedData["status"]
    //         ]);
   

    //         // $invoice = new Invoice();
    //         // $invoice->invoice_number = generateIdentifier("INV");
    //         // $invoice->customer_id = $validatedData["customer_id"];
    //         // $invoice->total_amount = $validatedData["total_amount"];
    //         // $invoice->payment_due = $validatedData["payment_due"];
    //         // $invoice->subtotal_amount = $validatedData["subtotal_amount"];
    //         // $invoice->discount = $validatedData["discount"];
    //         // $invoice->tax = $validatedData["tax"];
    //         // $invoice->note = $validatedData["note"];
    //         // $invoice->currency = $validatedData["currency"];
    //         // $invoice->status = $validatedData["status"];
    //         // $invoice->save();
    //         dd($invoiceService->printHello());
    //         dd("hello world");
    //         foreach ($validatedData['products'] as $productData) {

    //             $product = $invoice->products()->find($productData['product_id']);

    //             if (!$product) {
    //                 throw new ProductNotFoundException($productData["id"]);
    //             }
    //             $invoice->products()->attach($product, [
    //                 'quantity' => $productData['quantity'],
    //                 'unit_price' => $productData['unit_price']
    //             ]);

    //             $product->inventory()->decreaseQuantity($productData['quantity']);
    //         }
    //         if ($invoice) {
    //             return $this->success('Successfully created invoice');
    //         } 
    //         // });
    //         // DB::commit();
    //     } catch (Exception $e) {
    //         // DB::rollBack();
            
    //         return $this->serverError("Something went wrong while creating invoice {$e->getMessage()}");
    //     }
    //     // dd($data);
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        try {
            // return response()->json(["data" => $invoices]);
            return $this->success('', $invoice);
        } catch (ModelNotFoundException $e) {
            return $this->notFound("");
        } catch (Exception $e) {
            return $this->serverError("Something went wrong while trying to fetch invoice");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        try {
            $invoice->delete();
            return $this->success('', $invoice);
        } catch (Exception $e) {
            $this->serverError("Something went wrong while trying to delete invoice");
        }
    }
}
