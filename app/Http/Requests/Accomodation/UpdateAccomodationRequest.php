<?php

namespace App\Http\Requests\Accomodation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAccomodationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->permissions->accomodation_edit;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            //
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:20'],
            'city_id' => ['required', 'exists:cities,id', 'max:10'],
            'location' => ['nullable', 'string', 'max:300'],
            'capacity' => ['nullable', 'string', 'max:300'],
            'short_description' => ['nullable', 'string', 'max:300'],
            'description' => ['nullable', 'string'],
            'images.*' => 'file|mimes:jpeg,png,pdf,jpg,jfif|max:2000',
            'notes' => ['nullable', 'max:250'],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم إجباري',
            'name.max' => 'يجب ان يكون عدد محارف الاسم لا يتجاوز 100 محرف.',
            'short_description.max' => 'يجب ان يكون عدد محارف التفاصيل لا تتجاوز 300 محرف.',
            'description.max' => 'يجب ان يكون عدد محارف التفاصيل لا تتجاوز 1500 محرف.',
            'images.mimes' => 'الامتداد المرفق غير مسموح به فقط في هذه النوع: jpeg, png, pdf, jpg, jfif .',
            'images.max' => 'اقصى حجم للصور هو 20 ميغا بايت.',
            'notes.max' => 'يجب ان يكون عدد المحارف المكتوبة في الملاحظات لا يتجاوز 250 محرف.'
        ];
    }
}
