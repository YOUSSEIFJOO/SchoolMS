<?php

namespace Modules\ClassAcademic\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ClassAcademicDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('classAcademic')->insert([

            'name'              => "First",
            'capacity_sections' => "2",
            'capacity_subjects' => "2",
            'created_at'        => now(),
            'updated_at'        => now()

        ]);

    }
}
