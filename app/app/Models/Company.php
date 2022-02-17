<?php

namespace App\Models;

use App\Traits\UuidsModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, UuidsModels;


    /**
     * Получаем всех сотруднков данной компании
     *
     * @return void
     */
    public function staff()
    {
        // return $this->belongsTo(Company::class, 'staff', 'id', 'company_id');
        // return $this->belongsTo(Staff::class, 'id', 'company_id', 'staff');
        // return $this->belongsTo(Staff::class, 'id', 'company_id', 'staff');
        return $this->hasMany(Staff::class, 'company_id', 'id');

        // return $this->hasOne(Staff::class, 'id', 'compnay_id', 'staff');
    }
}
