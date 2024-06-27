<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
            $errors['title'] = 'required|unique:trainings,title|max:255';
        }else{
            $errors['title'] = 'required|max:255|unique:trainings,title,'.$this->training;
        }

        if(request()->method() == 'POST'){
            $errors['image'] = 'required_without:attachment|image|mimes:jpg,png,jpeg,gif|max:5120';
            $errors['attachment'] ='required_without:image|mimes:doc,docx,xls,xlsx,pdf|max:5120';
        }
        $errors['summary'] = 'sometimes | max:400';
        $errors['description'] = 'required | max:10000';
        $errors['status'] = 'required';
        $errors['order'] = 'required';
        $errors['quota'] = 'required';
        $errors['duration'] = 'required';
        $errors['eligibility'] = 'required';
        $errors['training_category_id'] = 'required';
        $errors['training_type_id'] = 'required';
        return $errors;
    }
}
