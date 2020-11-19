<?php

namespace Modules\Teachers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeachersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('teachers')->insert([

            'name'                  => "Ahmed",
            'birthday'              => "1997-05-20",
            'gender'                => "Male",
            'religion'              => "Muslim",
            'address'               => "Beni Suef Governorate - Beni Suef Center",
            'email'                 => "yousseifnady49@gmail.com",
            'photo'                 => "lx8SVGx8JFZyDuh_1604833525_1f4da69c452c629fd06a1a5ccde79a3e.jpg",
            'phoneNumber'           => "01148392978",
            'qualification'         => "Industrial diploma",
            'designation'           => "mattress",
            'joinDate'              => "2020-10-20",
            'class_id_teachers'     => "1",
            'section_id_teachers'   => "1",
            'subject_id_teachers'   => "1",
            'username'              => "tea",
            'password'              => encrypt("asdf1234"),
            'role'                  => "admin",
            'created_at'            => now(),
            'updated_at'            => now()

        ]);

        // $this->call("OthersTableSeeder");
    }
}
