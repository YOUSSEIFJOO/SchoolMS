<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeesAttendance', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("name", 55);
            $table->string("designation", 50);
            $table->date("date");
            $table->string("status", 7);

            /** Start Relationships **/
                $table->unsignedBigInteger('employee_id');
            /** End Relationships **/

            $table->timestamps();

            /** Start Foreign Keys **/
                $table->foreign('employee_id')->references('id')->on('employees')->onUpdate("cascade");
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
        Schema::table('employeesAttendance', function(Blueprint $table){
            $table->dropForeign(['employee_id']);
        });

        Schema::dropIfExists('employeesAttendance');
        Schema::enableForeignKeyConstraints();

    }
}
