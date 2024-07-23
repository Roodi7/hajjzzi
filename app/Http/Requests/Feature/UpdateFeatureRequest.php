<?php

namespace App\Http\Requests\Feature;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->permissions->feature_edit;
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
            'rating' => ['nullable', 'string', 'max:300'],
            'description' => ['nullable', 'string', 'max:1500'],
            'images.*' => 'file|mimes:jpeg,png,pdf,jpg,jfif|max:20000',
            'notes' => ['nullable', 'max:250'],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم إجباري',
            'name.max' => 'يجب ان يكون عدد محارف الاسم لا يتجاوز 100 محرف.',
            'rating.max' => 'يجب ان يكون عدد محارف التفاصيل لا تتجاوز 300 محرف.',
            'description.max' => 'يجب ان يكون عدد محارف التفاصيل لا تتجاوز 1500 محرف.',
            'images.mimes' => 'الامتداد المرفق غير مسموح به فقط في هذه النوع: jpeg, png, pdf, jpg, jfif .',
            'images.max' => 'اقصى حجم للصور هو 4 ميغا بايت.',
            'notes.max' => 'يجب ان يكون عدد المحارف المكتوبة في الملاحظات لا يتجاوز 250 محرف.'
        ];
    }
}
