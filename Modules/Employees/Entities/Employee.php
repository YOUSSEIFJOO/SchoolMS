<?php

namespace Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "employees";

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = [
        "id", "time", "name", "birthday", "gender", "religion", "address", "email", "photo", "phoneNumber",
        "qualification", "designation", "joinDate"
    ];

    /**
     * Query String For Select Some Fields From Main Categories Table.
     */
    public function scopeSelection($query)
    {
        return $query->select("id", "name", "designation");
    }

    /**
     * Get Upper Case Of First Letter Of Name.
     */
    public function getNameAttribute($val) {
        return ucwords($val);
    }
}
