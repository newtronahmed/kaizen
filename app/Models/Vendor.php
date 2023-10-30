<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'address',
        'city',
        'postcode',
        'country',
    ];

    public function purchase_order(){
        return $this->hasMany(PurchaseOrder::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
}
