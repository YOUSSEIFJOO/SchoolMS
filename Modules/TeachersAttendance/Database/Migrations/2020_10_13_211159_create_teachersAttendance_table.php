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

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachersAttendance');
    }
}
