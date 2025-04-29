<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetItemTotalAfterTaxAndDiscountRequest extends FormRequest
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
            'tax' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
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
            'tax.required' => __('messages.validation.tax_required'),
            'tax.numeric' => __('messages.validation.tax_numeric'),
            'tax.min' => __('messages.validation.tax_min'),
            'discount.required' => __('messages.validation.discount_required'),
            'discount.numeric' => __('messages.validation.discount_numeric'),
            'discount.min' => __('messages.validation.discount_min'),
        ];
    }
}