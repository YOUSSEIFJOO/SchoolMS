<?php

namespace Modules\Teachers\Entities;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "teachers";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = [
            "id", "name", "birthday", "gender", "religion", "address", "email", "photo", "phoneNumber",
            "qualification", "designation", "joinDate", "class_id_teachers", "section_id_teachers", "subject_id_teachers"
        ];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Student **/

            /** Get Student Attendance That Owns The Teacher. **/
            public function students()
            {
                return $this->hasMany('Modules\Students\Entities\Student');
            }

        /** End Relationship With Student **/


                            /***********************************************/


        /** Start Relationship With Teacher Attendance **/

            /** Get The Teacher Attendance That Owns The Teacher. **/
            public function teacherAttendances()
            {
                return $this->hasMany('Modules\TeachersAttendance\Entities\TeacherAttendance');
            }

        /** End Relationship With Teacher Attendance **/


                            /***********************************************/


        /** Start Relationship With Section Academic **/

            /** The Sections That Belong To The Teacher. **/
            public function sections()
            {
                return $this->belongsToMany('Modules\SectionAcademic\Entities\SectionAcademic');
            }

        /** End Relationship With Section Academic **/


                                /***********************************************/


        /** Start Relationship With Section Academic **/

            /** The Subjects That Belong To The Teacher. **/
            public function subjects()
            {
                return $this->belongsToMany('Modules\SubjectAcademic\Entities\SubjectAcademic');
            }

        /** End Relationship With Section Academic **/

    /** End Relationships **/

}
