<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachersAttendance', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("name", 55);
            $table->string("designation", 50);
            $table->date("date");
            $table->string("status", 7);

            /** Start Relationships **/
                $table->unsignedBigInteger('teacher_id');
            /** End Relationships **/

            $table->timestamps();

            /** Start Foreign Keys **/
                $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate("cascade");
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
        Schema::table('teachersAttendance', function(Blueprint $table){
            $table->dropForeign(['teacher_id']);
        });

        Schema::dropIfExists('teachersAttendance');
        Schema::enableForeignKeyConstraints();

    }
}
