<?php

namespace Modules\ClassAcademic\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassAcademic extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "classAcademic";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = ["id", "name", "capacity_sections", "capacity_subjects"];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Student Attendance **/

            /** Get Sections For The Class. **/
            public function sections()
            {
                return $this->hasMany('Modules\SectionAcademic\Entities\SectionAcademic');
            }

        /** End Relationship With Student Attendance **/


                        /***************************************************/


        /** Start Relationship With Student Attendance **/

            /** Get Subjects For The Class. **/
            public function subjects()
            {
                return $this->hasMany('Modules\SubjectAcademic\Entities\SubjectAcademic');
            }

        /** End Relationship With Student Attendance **/

    /** End Relationships **/

}
