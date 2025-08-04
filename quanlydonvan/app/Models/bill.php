<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'billCode',
        'dateCreate',
        'totalPrice',
        'paymentStatus',
        'order_id',
        'user_id',
        'surcharge_id',
        'feeManagement_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function surcharges(){
        return $this->hasMany(Surcharge::class, 'surcharge_id');
    }

    public function feeManagements(){
        return $this->hasMany(FeeManagement::class, 'feeManagement_id');
    }
}
