<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("name", 50);
            $table->date("birthday");
            $table->string("gender", 6);
            $table->string("religion", 9);
            $table->string("address", 30);
            $table->string("email", 50);
            $table->string("photo", 100);

            $table->string("phoneNumber", 11);
            $table->string("qualification", 70);
            $table->string("designation", 50);
            $table->date("joinDate");
            $table->integer("class_id_teachers");

            /** Start Relationships **/
                $table->unsignedBigInteger('section_id_teachers');
                $table->unsignedBigInteger("subject_id_teachers");
            /** End Relationships **/

            $table->timestamps();

            /** Start Foreign Keys **/
                $table->foreign('section_id_teachers')->references('id')->on('sectionAcademic')->onUpdate("cascade");
                $table->foreign('subject_id_teachers')->references('id')->on('subjectAcademic')->onUpdate("cascade");
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
        Schema::table('teachers', function(Blueprint $table){
            $table->dropForeign(['section_id_teachers', 'subject_id_teachers']);
        });

        Schema::dropIfExists('teachers');
        Schema::enableForeignKeyConstraints();

    }
}
