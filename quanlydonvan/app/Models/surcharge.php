<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surcharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'surchargeCode',
        'itemType',
        'price',
        'unit',
        'typeOfCustomer_id'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'surcharge_id');
    }
}
