<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements("id");

            $table->string("time");
            $table->string("name", 50);
            $table->date("birthday");
            $table->string("gender", 6);
            $table->string("religion", 9);
            $table->string("address", 30);
            $table->string("email", 50)->nullable();
            $table->string("photo", 100);
            $table->string("phoneNumber", 11);
            $table->string("qualification", 70);
            $table->string("designation", 50);
            $table->date("joinDate");

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
        Schema::dropIfExists('employees');
    }
}
