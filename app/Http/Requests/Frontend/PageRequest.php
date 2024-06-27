<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:10000',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg,gif|max:5120',
            'attachment' =>'sometimes|mimes:doc,docx,xls,xlsx,pdf|max:5120',
            'order' => 'required|integer',
        ];
    }
}
