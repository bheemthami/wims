<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        $errors['title'] = ['required', 'max:255', Rule::unique('training_categories', 'title')
            ->ignore($this->training_category),];

        $errors['status'] = 'required';
        $errors['order'] = 'required|numeric';
        $errors['image'] = 'sometimes|image|mimes:jpg,png,jpeg,gif|max:5120';

        return $errors;
    }
}
