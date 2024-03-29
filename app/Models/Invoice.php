<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'additionalCharges',    
        'totalAmount'
    ];
    public function repair(){
        return $this->belongsTo(Repair::class);
    }
}

