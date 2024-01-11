<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
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
