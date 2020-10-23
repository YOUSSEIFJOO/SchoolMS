<?php

namespace Modules\Employees\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get("employee_id");

        $rules = [

            "name"                  => "required | alpha | min:3 | max:50",

            "birthday"              => "required | date",

            "gender"                => "required",

            "religion"              => "required",

            "address"               => "required | string | min:10 | max:70",

            "email"                 => "required | email | min:15 | max:50 | unique:employees,email,$id",

            "photo"                 => "required | image",

            "phoneNumber"           => "required  | regex:/(01)[0-9]{9}/ | unique:employees,phoneNumber,$id",

            "qualification"         => "required | regex:/^[\pL\s\-]+$/u | min:3 | max:70",

            "designation"           => "required | regex:/^[\pL\s\-]+$/u | min:3 | max:50",

            "joinDate"              => "required | date"
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
