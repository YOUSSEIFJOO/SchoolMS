<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectAcademicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectAcademic', function (Blueprint $table) {
            $table->bigIncrements("id");

            $table->string('name');
            $table->Integer('code');
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
        Schema::dropIfExists('subjectAcademic');
    }
}
