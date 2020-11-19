<?php

namespace Modules\SectionAcademic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SectionAcademicDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('sectionacademic')->insert([

            'name'              => "A",
            'capacity_students' => "2",
            'class_id'          => "1",
            'created_at'        => now(),
            'updated_at'        => now()

        ]);

        // $this->call("OthersTableSeeder");
    }
}
