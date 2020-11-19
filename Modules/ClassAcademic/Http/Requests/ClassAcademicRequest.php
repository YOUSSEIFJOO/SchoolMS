<?php

namespace Modules\ClassAcademic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassAcademicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get("classAcademic_id");

        $rules = [

            "name"              => "required | alpha | min:3 | max:30 | unique:classAcademic,name,$id",

            "capacity_sections" => "required | numeric | gt:0",

            "capacity_subjects" => "required | numeric | gt:0",

        ];

        if($id) {

            $rules['name'] = "alpha | min:3 | max:30 | unique:classAcademic,name,$id";

        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
