<?php

namespace Modules\SubjectAcademic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectAcademicDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('subjectacademic')->insert([

            'name'          => "Math",
            'code'          => "2520",
            'class_id'      => "1",
            'created_at'    => now(),
            'updated_at'    => now()

        ]);

        // $this->call("OthersTableSeeder");
    }
}
