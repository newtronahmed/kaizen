<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('quantity', 'unit_price')->withTimestamps();
    }
    public function inventory()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function decreaseQuantity($quantity)
    {
        if ($this->quantity >= $quantity) {
            $this->quantity -= $quantity;
            $this->save();
            return true; // Quantity was successfully decreased.
        }
        return false; // Quantity is insufficient to deduct.
    }
    public function increaseQuantity($quantity)
    {
        $this->quantity += $quantity;
        $this->save();
    }
}
