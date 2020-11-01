<?php

namespace Modules\StudentsAttendance\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "studentsattendance";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = ["id", "name", "class_id_students", "section_id_students", "student_id", "date", "status"];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Student. **/

            /** Get the students that owns the Student Attendance. **/
            public function student()
            {
                return $this->belongsTo('Modules\Students\Entities\Student');
            }

        /** End Relationship With Student. **/

    /** End Relationships **/

}
