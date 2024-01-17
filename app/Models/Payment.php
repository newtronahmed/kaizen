<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [ "invoice_id", "payment_method", "payment_date", "amount"];
    public function invoice (){
        return $this->belongsTo(Invoice::class);
    }
}
