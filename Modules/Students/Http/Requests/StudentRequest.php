<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = $this->request->get("student_id");

        $rules = [

            "name"                  => "required | alpha | min:3 | max:15 | different:fatherName",

            "birthday"              => "required | date",

            "gender"                => "required",

            "religion"              => "required",

            "address"               => "required | string | min:10 | max:70",

            "email"                 => "required | email | min:15 | max:50 | unique:students,email,$id",

            "photo"                 => "required | image",

            "phoneNumber"           => "required  | regex:/(01)[0-9]{9}/ | unique:students,phoneNumber,$id | different:phoneNumberFather",

            "fatherName"            => "required | regex:/^[\pL\s\-]+$/u | min:9 | max:40 | different:motherName",

            "phoneNumberFather"     => "required | regex:/(01)[0-9]{9}/ | unique:students,phoneNumberFather,$id | different:phoneNumberMother",

            "motherName"            => "required | regex:/^[\pL\s\-]+$/u | min:9 | max:40 | different:name",

            "phoneNumberMother"     => "required | regex:/(01)[0-9]{9}/ | unique:students,phoneNumberMother,$id | different:phoneNumber",

            "notificationSms"       => "required",

            "shift"                 => "required",

            "class_id_students"     => "required",

            "section_id_students"   => "required"
        ];

        if($id) {
            $rules['photo'] = "image";
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
