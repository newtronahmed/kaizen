<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Traits\HttpResponseTrait;
use Exception;

class DiscountController extends Controller
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
            $discounts = Discount::all();
            return $this->success('', $discounts);
        } catch (Exception $e) {
           return $this->serverError('Something went wrong while fetching discount');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountRequest $request)
    {
        try {
            $discount = Discount::create($request->validated());
            return $this->success('', $discount);
        } catch (Exception $e) {
            return $this->serverError("Something went wrong while creating {$e->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        try {
           return $this->success('', $discount);
        } catch (Exception $e) {
            return $this->serverError("Something went wrong while fetching discount {$e->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountRequest  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        try {
            $discount->delete();
            return $this->success('');
        } catch (Exception $e) {
            return $this->serverError();
        }
    }
}
