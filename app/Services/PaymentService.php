<?php

namespace App\Services;

use App\Exceptions\PaymentFailedException;
use App\Models\Payment;
use App\Models\Invoice;
use App\Traits\HttpResponseTrait;
use Exception;

class PaymentService
{
    use HttpResponseTrait;

    public function makePayment(array $data)
    {
        try {
            $invoice = Invoice::find($data["invoice_id"]);

            if ($invoice->remaining_balance < $data["amount"]) {
                throw new PaymentFailedException("Amount is greater than remaining balance");
            }
            $invoice->update([
                'remaining_balance' => $invoice->remaining_balance - $data["amount"],
            ]);

            $payment = Payment::create([
                "invoice_id" => $data["invoice_id"],
                'payment_method' => $data["payment_method"],
                'payment_date' => $data["payment_date"],
                'amount' => $data["amount"],
            ]);
            //event payment made
            return $this->success('Successfully made payment', $payment);
            // return $payment;
        } catch (PaymentFailedException $e) {
            // return $this->serverError("Something went wrong while making payment {$e->getMessage()}");
            return $this->badRequest($e->getMessage());
        } catch (Exception $e) {
            return $this->serverError("Something went wrong while making payment {$e->getMessage()}");
        }
    }
}
