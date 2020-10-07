<?php

namespace Modules\Teachers\Entities;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "teachers";

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = [
        "id", "name", "birthday", "gender", "religion", "address", "email", "photo", "phoneNumber",
        "qualification", "designation", "joinDate", "subjects", "class", "section"
    ];

    /**
     * Query String For Select Some Fields From Main Categories Table.
     */
    public function scopeSelection($query)
    {
        return $query->select("id", "name", "class", "section", "designation");
    }

    /**
     * Get Upper Case Of First Letter Of Name.
     */
    public function getNameAttribute($val) {
        return ucwords($val);
    }
}
