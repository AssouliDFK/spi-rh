<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends User
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'belongs_to_company',
    ];

    public function company(){
        return $this->hasOne(Company::class, 'belongs_to_company','id');
    }
    // Define any additional relationships or methods specific to the Employee model.
}