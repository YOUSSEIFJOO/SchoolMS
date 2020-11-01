<?php

namespace Modules\EmployeesAttendance\Entities;

use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "employeesattendance";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = ["id", "name", "designation", "date", "status", "employee_id"];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Employee. **/

            /** Get the Employees that owns the Employee Attendance. **/
            public function employee()
            {
                return $this->belongsTo('Modules\Employees\Entities\Employee');
            }

        /** End Relationship With Employee. **/

    /** End Relationships **/

}
