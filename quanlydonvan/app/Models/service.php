<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;

    protected $fillable = [
        'serviceCode',
        'nameService',
        'country',
        'nameCompany',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
