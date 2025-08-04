<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feeManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'feeCode',
        'typeOfCustomer_id',
        'minWeight',
        'maxWeight',
        'price'
    ];

    public function bill(){
        return $this->belongsTo(Bill::class, 'feeManagement_id');
    }
}
