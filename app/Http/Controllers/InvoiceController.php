<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Traits\HttpResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    public function store(StoreInvoiceRequest $request)
    {
        $validatedData = $request->validated();

        $invoice = Invoice::create([
            'invoice_number' => generateIdentifier("INV"),
            'customer_id' => $validatedData["customer_id"],
            'total_amount' => $validatedData["total_amount"],
            'payment_due' => $validatedData["payment_due"],
            'subtotal_amount' => $validatedData["subtotal_amount"],
            'discount' => $validatedData["discount"],
            'tax' => $validatedData["tax"],
            'note' => $validatedData["note"],
            'currency' => $validatedData["currency"],
            'status' => $validatedData["status"]
        ]);


    }

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
        } catch(Exception $e){
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
        //
    }
}
