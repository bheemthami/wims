<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'municipality' => 'required|min:3|max:255',
            'office' => 'required|min:3|max:255',
            'office_address' => 'required|min:3|max:255',
            'province_name' => 'required|min:3|max:255',
            'district_name' => 'required|min:3|max:255',
            'system_name' => 'required|min:3|max:255',
            'system_short_name' => 'required|min:3|max:255',
            'tag_line' => 'required|min:3|max:255',
            'academic_year_id' => 'required|numeric',
            'province_name' => 'required|min:3|max:255',
            'province_name' => 'required|min:3|max:255',
            'province_name' => 'required|min:3|max:255',
            'province_name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'logo' => 'sometimes|image|mimes:jpg,png,jpeg|max:5120',
            'local_logo' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:5120',
            'favicon' => 'sometimes|image|mimes:png,ico|max:5120',
        ];
    }
}
