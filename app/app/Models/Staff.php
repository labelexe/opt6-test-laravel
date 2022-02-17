<?php

namespace App\Models;

use App\Traits\UuidsModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory, UuidsModels;


    /**
     * Get Companies
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
