<?php

namespace Modules\SubjectAcademic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectAcademicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = $this->request->get("subjectAcademic_id");

        $rules = [

            "name"      => "required | alpha | min:3 | max:30 | unique:subjectacademic,name,$id",

            "code"      => "required | numeric | min:0 | not_in:0 | digits_between:1,15 | unique:subjectacademic,code,$id",

            "class_id"  => "required",

        ];

        if($id) {

            $rules['name'] = "alpha | min:3 | max:30 | unique:subjectacademic,name,$id";

            $rules['code'] = "numeric | min:0 | not_in:0 | digits_between:1,15 | unique:subjectacademic,code,$id";

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
