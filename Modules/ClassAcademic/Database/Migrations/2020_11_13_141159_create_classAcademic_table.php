<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassAcademicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classAcademic', function (Blueprint $table) {

            $table->bigIncrements("id");

            $table->string('name');
            $table->smallInteger('capacity_sections');
            $table->smallInteger('capacity_subjects');

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
        Schema::dropIfExists('classAcademic');
    }
}
