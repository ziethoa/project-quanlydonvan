<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transportUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'transportUnitCode',
        'nameTU',
        'country'
    ];

    public function infoOrders(){
        return $this->hasMany(infoOrder::class, 'transportUnit_id');
    }
}
