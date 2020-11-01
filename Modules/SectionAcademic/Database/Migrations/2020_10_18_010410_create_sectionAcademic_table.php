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

            /** Start Relationships **/
                $table->unsignedBigInteger('class_id');
            /** End Relationships **/

            $table->timestamps();

            /** Start Foreign Keys **/
                $table->foreign('class_id')->references('id')->on('classAcademic')->onUpdate("cascade");
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
        Schema::table('sectionAcademic', function(Blueprint $table){
            $table->dropForeign(['class_id']);
        });

        Schema::dropIfExists('sectionAcademic');
        Schema::enableForeignKeyConstraints();

    }
}
