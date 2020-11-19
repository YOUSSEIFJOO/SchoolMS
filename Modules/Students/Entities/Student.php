<?php

namespace Modules\Students\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticatable
{

    /** Start Trait Of Spatie Package **/
        use HasRoles;
    /** Start Trait Of Spatie Package **/


    /******************************************************************************************************************/


    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "students";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = [
            "id", "name", "birthday", "gender", "religion", "address", "email", "photo", "phoneNumber", "fatherName",
            "phoneNumberFather", "motherName", "phoneNumberMother", "shift", "notificationSms", "class_id_students",
            "section_id_students", "username", "password", "role"
        ];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Teacher **/

            /** Get Teachers For The Student. **/
            public function teachers()
            {
                return $this->belongsToMany('Modules\Teachers\Entities\Teacher');
            }

        /** End Relationship With Teacher **/


                        /***********************************************/


        /** Start Relationship With Student Attendance **/

            /** Get The Student Attendance For The Student. **/
            public function studentAttendances()
            {
                return $this->hasMany('Modules\StudentsAttendance\Entities\StudentAttendance');
            }

        /** End Relationship With Student Attendance **/


                                /***********************************************/


        /** Start Relationship With Section Academic **/

            /** Get The Section That Owns The Student. **/
            public function section()
            {
                return $this->belongsTo('Modules\SectionAcademic\Entities\SectionAcademic');
            }

        /** End Relationship With Section Academic **/


                            /***********************************************/


        /** Start Relationship With Subject Academic **/

            /** Get Subjects For The Student. **/
            public function subjects()
            {
                return $this->belongsTo('Modules\SubjectAcademic\Entities\SubjectAcademic');
            }

        /** End Relationship With Subject Academic **/

    /** End Relationships **/

}
