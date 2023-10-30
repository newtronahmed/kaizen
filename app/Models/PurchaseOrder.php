<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    // protected $table = 'product_purchase_orders';
    public function products () {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    // public function invoice () {
    //     return $this->hasOne()
    // }
    public function vendor () {
        return $this->belongsTo(Vendor::class);
    }
}
