<?php

namespace Modules\SubjectAcademic\Entities;

use Illuminate\Database\Eloquent\Model;

class SubjectAcademic extends Model
{

    /** Start $table Variable **/

        /** Handel The Name Of Table Related With This Model. **/
        protected $table = "subjectacademic";

    /** End $table Variable **/


    /******************************************************************************************************************/


    /** Start $fillable Variable **/

        /** The attributes that are mass assignable. **/
        protected $fillable = ["id", "name", "code", "class_id"];

    /** End $fillable Variable **/


    /******************************************************************************************************************/


    /** Start Relationships **/

        /** Start Relationship With Class Academic **/

            /** Get The Students For The Subject. **/
            public function students()
            {
                return $this->belongsTo('Modules\Students\Entities\Student');
            }

        /** End Relationship With Section Academic **/


                            /************************************************/

        /** Start Relationship With Teacher **/

            /** Get Teachers That Belong To The Subject. **/
            public function teachers()
            {
                return $this->belongsTo('Modules\Teachers\Entities\Teacher');
            }

        /** End Relationship With Teacher **/


                        /************************************************/


        /** Start Relationship With Class Academic **/

            /** Get The Class That Owns The Section. **/
            public function class()
            {
                return $this->belongsTo('Modules\ClassAcademic\Entities\ClassAcademic');
            }

        /** End Relationship With Section Academic **/

    /** End Relationships **/
}
