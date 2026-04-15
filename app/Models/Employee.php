<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company_id',
        'manager_id',
        'position',
        'country',
        'state',
        'city'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function manager() {
        return $this->belongsTo(Employee::class, 'manager_id');
    }
}