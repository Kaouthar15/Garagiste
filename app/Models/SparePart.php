<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'partName',
        'partReference',
        'supplier',
        'price',
    ];
    public function repair()
    {
        return $this->belongsToMany(Repair::class);
    }


}
