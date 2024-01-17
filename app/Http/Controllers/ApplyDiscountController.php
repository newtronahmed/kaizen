<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Traits\HttpResponseTrait;
use Exception;
use Illuminate\Http\Request;

class ApplyDiscountController extends Controller
{
    use HttpResponseTrait;
    public function verifyDiscount(Request $req)
    {
        try {
            $discount = Discount::where('code', '=', $req->input('code'));
            if ($discount) {
                return response()->json(["message"=> "Unknown Discount"])->status(400);
            }
            if (!$discount->start_date >= today() || !$discount->end_date <= today()) {
                return response()->json(["message" => "Discount expired"])->status(400);
            }
            return response()->json(["message" => "Discount is valid", "data" => $discount]);
            //code...
        } catch (Exception $e) {
            return $this->serverError('Something went wrong while applying discount');
        }
    }
}
