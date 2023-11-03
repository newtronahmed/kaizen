<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReceives extends Model
{
    use HasFactory;
    public function purchaseOrder() {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
}
