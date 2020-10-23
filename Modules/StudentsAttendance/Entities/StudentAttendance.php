<?php

namespace Modules\StudentsAttendance\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "studentsattendance";

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = ["id", "name", "class", "section", "date", "status"];

    /**
     * Query String For Select Some Fields From Main Student Attendance Table.
     * @param $query
     * @return query
     */
    public function scopeSelection($query)
    {
        return $query->select("id", "name", "class", "section", "date", "status");
    }
}
