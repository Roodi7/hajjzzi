<?php

namespace App\Http\Requests\Term;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTermRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->permissions->term_edit;
    }

    /**
     * Get the validation rules that apply to the request.s
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            //
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1500'],

        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم إجباري',
            'name.max' => 'يجب ان يكون عدد محارف الاسم لا يتجاوز 100 محرف.',
            'description.max' => 'يجب ان يكون عدد محارف التفاصيل لا تتجاوز 1500 محرف.',

        ];
    }
}
