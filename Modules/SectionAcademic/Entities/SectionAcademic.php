<?php

namespace Modules\SectionAcademic\Entities;

use Illuminate\Database\Eloquent\Model;

class SectionAcademic extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "sectionacademic";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = ["id", "name", "capacity_students", "class_id"];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Student **/

            /** Get The Student For The Section. **/
            public function students()
            {
                return $this->hasMany('Modules\Students\Entities\Student');
            }

        /** End Relationship With Student **/


                            /***********************************************/


        /** Start Relationship With Teachers **/

            /** Get Teachers That Belong To The Subject. **/
            public function teachers()
            {
                return $this->belongsToMany('Modules\Teachers\Entities\Teacher');
            }

        /** End Relationship With Teachers **/


                        /***********************************************/


        /** Start Relationship With Class Academic **/

            /** Get The Class That Owns The Section. **/
            public function class()
            {
                return $this->belongsTo('Modules\ClassAcademic\Entities\ClassAcademic');
            }

        /** Start Relationship With Class Academic **/

    /** End Relationships **/

}
