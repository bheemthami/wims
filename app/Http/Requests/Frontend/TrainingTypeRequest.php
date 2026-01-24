<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrainingTypeRequest extends FormRequest
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

        $errors['title'] = ['required', 'max:255', Rule::unique('training_types', 'title')
            ->ignore($this->training_type),];
        $errors['status'] = 'required';
        $errors['order'] = 'required';

        return $errors;
    }
}
