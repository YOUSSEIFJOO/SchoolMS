<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {

        Schema::create('students', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("name", 15);
            $table->date("birthday");
            $table->string("gender", 6);
            $table->string("religion", 9);
            $table->string("address", 70);
            $table->string("email", 50);
            $table->string("photo", 100);
            $table->string("phoneNumber", 11);
            $table->string("fatherName", 40);
            $table->string("phoneNumberFather", 11);
            $table->string("motherName", 40);
            $table->string("phoneNumberMother", 11);
            $table->string("shift", 7);
            $table->string("notificationSms", 25);
            $table->integer('class_id_students');

            $table->string("username", 10)->unique();
            $table->string("password");
            $table->string("role", 7)->default("student");

            /** Start Relationships **/
                $table->unsignedBigInteger('section_id_students');
            /** End Relationships **/

            $table->timestamps();

            /** Start Foreign Keys **/
                $table->foreign('section_id_students')->references('id')->on('sectionAcademic')->onUpdate("cascade");
            /** End Foreign Keys **/

        });

    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {

        /** For Skip Foreign Key In Update Or Delete For Solve Error (Cannot delete or update a parent row a foreign key constraint fails) **/
        Schema::disableForeignKeyConstraints();
        Schema::table('students', function(Blueprint $table){
            $table->dropForeign(['section_id_students']);
        });

        Schema::dropIfExists('students');
        Schema::enableForeignKeyConstraints();

    }
}
