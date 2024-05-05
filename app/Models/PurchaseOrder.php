<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['vendor_id', 'order_date', 'expected_delivery_date', 'total_amount', 'payment_terms', 'due_date', 'status', 'note'];
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
