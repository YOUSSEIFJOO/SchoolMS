<?php

namespace Modules\TeachersAttendance\Entities;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "teachersattendance";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = ["id", "name", "designation", "date", "status", "teacher_id"];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Teacher. **/

            /** Get the Teachers that owns the Teacher Attendance. **/
            public function teacher()
            {
                return $this->belongsTo('Modules\Teachers\Entities\Teacher');
            }

        /** End Relationship With Teacher. **/

    /** End Relationships **/

}
