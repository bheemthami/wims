<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class TrainingCategoryRequest extends FormRequest
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
            $errors['title'] = 'required|unique:training_categories,title|max:255';
        }else{
            $errors['title'] = 'required|max:255|unique:training_categories,title'.$this->id;
        }

        $errors['status'] = 'required';
        $errors['order'] = 'required';
        $errors['image'] = 'sometimes|image|mimes:jpg,png,jpeg,gif|max:5120';

        return $errors;
    }
}
