<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'billOfLandingNumber',
        'nameTU',
        'dayStart',
        'orderContent',
        'trackingNumber',
        'declaredValue',
        'transportUnit_id'
    ];

    public function transportUnit(){
        return $this->belongsTo(TransportUnit::class, 'transportUnit_id');
    }
}
