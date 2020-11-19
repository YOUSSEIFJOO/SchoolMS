<?php

namespace Modules\Students\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StudentsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('students')->insert([

            'name'                  => "Youssief",
            'birthday'              => "1997-05-20",
            'gender'                => "Male",
            'religion'              => "Muslim",
            'address'               => "Beni Suef Governorate - Beni Suef Center",
            'email'                 => "yousseifnady49@gmail.com",
            'photo'                 => "9LjzlIjKI8R6kgA_1604833696_123.jpg",
            'phoneNumber'           => "01148392978",
            'fatherName'            => "Nady",
            'phoneNumberFather'     => "01148392975",
            'motherName'            => "Maha",
            'phoneNumberMother'     => "01148392974",
            'shift'                 => "Morning",
            'notificationSms'       => "Father's Phone Number",
            'class_id_students'     => "1",
            'username'              => "you",
            'password'              => encrypt("zxcvbnma"),
            'section_id_students'   => "1",
            'created_at'            => now(),
            'updated_at'            => now()

        ]);

        // $this->call("OthersTableSeeder");
    }
}
