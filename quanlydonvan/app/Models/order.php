<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderCode',
        'typeOfCustomer_id',
        'orderCreationDate',
        'sender_id',
        'receiver_id',
        'service_id',
        'user_id'
    ];

    public function typeOfCustomer(){
        
    }
}
