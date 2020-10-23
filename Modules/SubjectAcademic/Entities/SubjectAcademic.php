<?php

namespace Modules\SubjectAcademic\Entities;

use Illuminate\Database\Eloquent\Model;

class SubjectAcademic extends Model
{
    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "subjectacademic";

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = ["id", "name", "code", "class_id"];

    /**
     * Get The Class That Owns The Subject.
     */
    public function class()
    {
        return $this->belongsTo('Modules\ClassAcademic\Entities\ClassAcademic');
    }

    /**
     * Query String For Select Some Fields From Main Categories Table.
     */
    public function scopeSelection($query)
    {
        return $query->select("id", "name", "code", "class_id");
    }

    /**
     * Get Upper Case Of First Letter Of Name.
     */
    public function getNameAttribute($val) {
        return ucwords($val);
    }
}
