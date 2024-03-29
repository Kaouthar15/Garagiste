<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'make',
        'model',
        'fuelType',
        'registration',
        'images',
    ]; 

    public function vehiculetable()
    {
        return $this->morphTo();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function repair(){
        return $this->morphMany(Repair::class,'repairtable'); 
    }
   
}
