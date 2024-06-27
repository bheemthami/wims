<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

use Carbon\Carbon;

class OfficialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'department_id' =>"required",
            'academic_year_id' =>"required",
            'designation_id' =>"required",
            'local_level_type_id' =>'required',
            'first_name' =>"required|max:255",
            'last_name' =>"required|max:255",
            'dob' =>"required",
            'gender' =>"required",
            'district' =>"required|max:255",
            'municipality' =>"required|max:255",
            'ward_no' =>"sometimes|numeric",
            'joining_date' =>'required',
            'leaving_date' => 'sometimes|nullable',
            'mobile' =>"required",
            'working_status'=>'required',
            'status' => 'required',
            'email' => 'sometimes|nullable|email',
            'is_teaching_official'=>'required',
            'order'=>'required|integer'
        ];
    }
}
