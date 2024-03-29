<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'description',
        'status',
        'startDate',
        'endDate',
        'mechanicNotes',
        'clientNotes',
    ];

    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    } 
    public function repairtable()
    {
        return $this->morphTo();
    }
    public function sparePart()
    {
        return $this->belongsToMany(SparePart::class); 
    }

}
