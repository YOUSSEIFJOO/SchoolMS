<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionAcademicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectionAcademic', function (Blueprint $table) {
            $table->bigIncrements("id");

            $table->string('name');
            $table->Integer('capacity_students');
            $table->unsignedBigInteger('class_id');

            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classAcademic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sectionAcademic');
    }
}
