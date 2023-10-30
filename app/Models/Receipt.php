<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
