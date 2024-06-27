<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
        $errors['title'] = 'required|max:255';

        if(request()->method() == 'POST'){
            $errors['image'] = 'required_without:attachment|image|mimes:jpg,png,jpeg,gif|max:5120';
            $errors['attachment'] ='required_without:image|mimes:doc,docx,xls,xlsx,pdf|max:5120';
        }
        $errors['academic_year_id'] = 'required';
        $errors['document_type_id'] = 'required';
        $errors['order'] = 'required';
        $errors['date'] = 'required';
        return $errors;
    }
}
