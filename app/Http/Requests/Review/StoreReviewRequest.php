<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'required|min:1|max:5',
            'comment' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => 'حقل التقييم اجباري',
            'rating.min' => 'التقييم على الاقل 1',
            'rating.max' => 'اعلى تقييم ممكن هو 5',
            'comment.string' => 'يجب ان يكون حقل التعليق هو محارف',
            'comment.max' => 'يجب ان لا يتجاوز التعليق 250 محرف',
        ];

    }
}
