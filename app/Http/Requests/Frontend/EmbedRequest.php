<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class EmbedRequest extends FormRequest
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
            $errors['type'] = 'required|unique:embeds,type|max:255';
        }else{
            $errors['type'] = 'required|max:255|unique:embeds,type,'.$this->embedding;
        }
        $errors['iframe'] = 'required';
        $errors['status'] = 'required';

        return $errors;
    }
}
