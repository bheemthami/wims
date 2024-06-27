<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'title' => 'required | max:255',
            'date'  => 'required',
            'type'  => 'required',
            'image.*' =>  'required_if:type,image|mimes:jpg,png,jpeg,gif|max:10240',
            'academic_year_id' => 'required',
            'link' => 'required_if:type,video',
            'status' => 'required'
        ];
    }
}
