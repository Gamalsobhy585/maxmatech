<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetSellingPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'product_id.required' => __('messages.validation.product_id_required'),
            'product_id.exists' => __('messages.validation.product_id_exists'),
            'category_id.required' => __('messages.validation.category_id_required'),
            'category_id.exists' => __('messages.validation.category_id_exists'),
        ];
    }
}