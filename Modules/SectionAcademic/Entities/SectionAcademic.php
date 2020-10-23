<?php

namespace Modules\SectionAcademic\Entities;

use Illuminate\Database\Eloquent\Model;

class SectionAcademic extends Model
{
    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "sectionacademic";

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = ["id", "name", "capacity_students", "class_id"];

    /**
     * Get The Class That Owns The Section.
     */
    public function class()
    {
        return $this->belongsTo('Modules\ClassAcademic\Entities\ClassAcademic');
    }

    /**
     * Get The students For The Section.
     */
    public function students()
    {
        return $this->hasMany('Modules\Students\Entities\Student');
    }

    /**
     * Query String For Select Some Fields From Main Categories Table.
     */
    public function scopeSelection($query)
    {
        return $query->select("id", "name", "capacity_students", "class_id");
    }

    /**
     * Get Upper Case Of First Letter Of Name.
     */
    public function getNameAttribute($val) {
        return ucwords($val);
    }
}
