<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // Add any other attributes specific to the Company model.
    ];

    // Define any relationships, for example, if a company has many employees.
    public function employees()
    {
        return $this->hasMany(Employee::class, 'belongs_to_company', 'id');
    }
}