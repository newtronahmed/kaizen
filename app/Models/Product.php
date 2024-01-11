<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('quantity', 'unit_price')->withTimestamps();
    }
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
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
    public function category() {
        return $this->hasOne(Category::class);
    }

    
}
