<?php

namespace Modules\SectionAcademic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionAcademicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [

            "name"              => "required | alpha | min:1 | max:30",

            "capacity_students" => "required | numeric | gt:0",

            "class_id"          => "required",

        ];
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
