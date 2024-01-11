<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'unit_price')->withTimestamps();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
