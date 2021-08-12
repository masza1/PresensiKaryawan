<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function salaries(){
        return $this->hasMany(Salary::class);
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function overtimes() {
        return $this->hasMany(Overtime::class);
    }
    
}