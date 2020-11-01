<?php

namespace Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "employees";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = [
            "id", "time", "name", "birthday", "gender", "religion", "address", "email", "photo", "phoneNumber",
            "qualification", "designation", "joinDate"
        ];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Student Attendance **/

            /** Get The Employee Attendance For The Employee. **/
            public function employeeAttendances()
            {
                return $this->hasMany('Modules\EmployeesAttendance\Entities\EmployeeAttendance');
            }

        /** End Relationship With Student Attendance **/

    /** End Relationships **/

}
