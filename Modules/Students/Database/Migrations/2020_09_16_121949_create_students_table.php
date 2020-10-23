<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements("id");

            $table->string("time");
            $table->string("name", 15);
            $table->date("birthday");
            $table->string("gender", 6);
            $table->string("religion", 9);
            $table->string("address", 30);
            $table->string("email", 50);
            $table->string("photo", 100);
            $table->string("phoneNumber", 11);
            $table->string("fatherName", 40);
            $table->string("phoneNumberFather", 11);
            $table->string("motherName", 40);
            $table->string("phoneNumberMother", 11);
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->string("shift", 7);
            $table->string("notificationSms", 25);

            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classAcademic');
            $table->foreign('section_id')->references('id')->on('SectionAcademic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
