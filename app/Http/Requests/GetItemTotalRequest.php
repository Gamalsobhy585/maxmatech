<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetItemTotalRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'product_id.required' => __('messages.validation.product_id_required'),
            'product_id.exists' => __('messages.validation.product_id_exists'),
            'category_id.required' => __('messages.validation.category_id_required'),
            'category_id.exists' => __('messages.validation.category_id_exists'),
            'quantity.required' => __('messages.validation.quantity_required'),
            'quantity.integer' => __('messages.validation.quantity_integer'),
            'quantity.min' => __('messages.validation.quantity_min'),
        ];
    }
}