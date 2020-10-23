<?php

namespace Modules\EmployeesAttendance\Entities;

use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    /**
     * Handel The Name Of Table Related With This Model.
     * var String
     */
    protected $table = "employeesattendance";

    /**
     * The attributes that are mass assignable.
     * var array
     */
    protected $fillable = ["id", "name", "designation", "date", "status"];

    /**
     * Query String For Select Some Fields From Main Student Attendance Table.
     * @param $query
     * @return query
     */
    public function scopeSelection($query)
{
    return $query->select("id", "name", "designation", "date", "status");
}
}
