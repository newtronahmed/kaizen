<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorRequest;
use App\Models\Vendor;
use App\Traits\HttpResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class VendorController extends Controller
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
            $vendors = Vendor::all();
            return $this->success("success", $vendors);
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
    public function store(StoreVendorRequest $request)
    {
        try {
            $vendor = Vendor::create($request->validated());
            return $this->success('Successfully created vendor', $vendor);
        } catch (Exception $exception) {
            return $this->badRequest($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        try {
            return $this->success('', $vendor);
        } catch (ModelNotFoundException $e) {
            // Handle the exception here
            return $this->notFound("Vendor not found",);
        } catch (Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
     * @param  \App\Models\Vendor vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        try {
            $vendor->delete();
            return $this->success("Successfuly deleted vendor");
        } catch (ModelNotFoundException $e) {
            return $this->notFound("Vendor not found",);
        } catch (Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
