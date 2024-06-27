<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class QuickLinkRequest extends FormRequest
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
        $errors = [];

        if(request()->method() == 'POST'){
            $errors['title'] = 'required|unique:programs,title|max:255';
        }else{
            $errors['title'] = 'required|max:255|unique:programs,title,'.$this->quick_link;
        }

        $errors['link'] = 'required|max:255';
        $errors['order'] = 'required';
        $errors['status'] = 'required';
        return $errors;
    }
}
