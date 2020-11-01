<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentsAttendance', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("name", 55);
            $table->integer("class_id_students");
            $table->integer("section_id_students");

            /** Start Relationships **/
                $table->unsignedBigInteger('student_id');
            /** End Relationships **/

            $table->date("date");
            $table->string("status", 7);

            $table->timestamps();

            /** Start Foreign Keys **/
                $table->foreign('student_id')->references('id')->on('students')->onUpdate("cascade");
            /** End Foreign Keys **/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        /** For Skip Foreign Key In Update Or Delete For Solve Error (Cannot delete or update a parent row a foreign key constraint fails) **/
        Schema::disableForeignKeyConstraints();
        Schema::table('studentsAttendance', function(Blueprint $table){
            $table->dropForeign(['student_id']);
        });

        Schema::dropIfExists('studentsAttendance');
        Schema::enableForeignKeyConstraints();

    }
}
