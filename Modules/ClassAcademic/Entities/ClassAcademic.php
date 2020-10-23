<?php

namespace Modules\ClassAcademic\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassAcademic extends Model
{
    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "classacademic";

    /**
     * Get The Subjects For The Class.
     */
    public function subjects()
    {
        return $this->hasMany('Modules\SubjectAcademic\Entities\SubjectAcademic');
    }

    /**
     * Get The students For The Class.
     */
    public function students()
    {
        return $this->hasMany('Modules\Students\Entities\Student');
    }

    /**
     * Get The Sections For The Class.
     */
    public function sections()
    {
        return $this->hasMany('Modules\SectionAcademic\Entities\SectionAcademic');
    }

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = ["id", "name", "capacity_sections", "capacity_subjects"];

    /**
     * Query String For Select Some Fields From Main Categories Table.
     */
    public function scopeSelection($query)
    {
        return $query->select("id", "name", "capacity_sections", "capacity_subjects");
    }

    /**
     * Get Upper Case Of First Letter Of Name.
     */
    public function getNameAttribute($val) {
        return ucwords($val);
    }
}
