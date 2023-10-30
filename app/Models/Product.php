<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function invoices() {
        return $this->belongsToMany(Invoice::class)->withPivot('quantity', 'unit_price')->withTimestamps();
    }
    public function inventory () {
        return $this->belongsTo(Invoice::class);
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
}
