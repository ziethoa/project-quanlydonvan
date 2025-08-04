<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    protected $fillable = [
        'companyCode',
        'nameCompany',
        'address',
        'email',
        'phone',
        'region'
    ];

    public function services(){
        return $this->hasMany(Service::class, 'company_id');
    }
}
