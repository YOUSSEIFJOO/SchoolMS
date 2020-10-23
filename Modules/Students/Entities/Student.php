<?php

namespace Modules\Students\Entities;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "students";

    /**
     * Get The Class That Owns The Student.
     */
    public function class()
    {
        return $this->belongsTo('Modules\ClassAcademic\Entities\ClassAcademic');
    }

    /**
     * Get The Class That Owns The Section.
     */
    public function section()
    {
        return $this->belongsTo('Modules\SectionAcademic\Entities\SectionAcademic');
    }

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = [
        "id", "time", "name", "birthday", "gender", "religion", "address", "email", "photo", "phoneNumber",
        "fatherName", "phoneNumberFather", "motherName", "phoneNumberMother", "class_id",
        "section_id", "shift", "notificationSms"
    ];

    /**
     * Query String For Select Some Fields From Main Categories Table.
     */
    public function scopeSelection($query)
    {
        return $query->select("id", "name", "fatherName", "class_id", "section_id");
    }

    /**
     * Query String For Select Some Fields From Main Student Attendance Table.
     */
    public function scopeSelectionCreate($q)
    {
        return $q->select("name", "fatherName", "class", "section");
    }

    /**
     * Get Upper Case Of First Letter Of Father Name.
     */
    public function getFatherNameAttribute($val) {
        return ucwords($val);
    }

    /**
     * Get Upper Case Of First Letter Of Name.
     */
    public function getNameAttribute($val) {
        return ucwords($val);
    }
}
