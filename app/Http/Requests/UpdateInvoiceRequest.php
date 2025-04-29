<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => 'required|in:cash,credit',
            'original_invoice_number' => 'nullable|required_if:type,2,3|exists:invoices,invoice_number',
            'total' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'tax_table' => 'required|numeric|min:0',
            'tax_additional' => 'required|numeric|min:0',
            'net_amount' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.category_id' => 'required|exists:categories,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.selling_unit_price' => 'required|numeric|min:0',
            'items.*.discount' => 'required|numeric|min:0',
            'items.*.tax' => 'required|numeric|min:0',
            'items.*.total' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => __('messages.validation.type_required'),
            'type.in' => __('messages.validation.type_in'),
            'payment_method.required' => __('messages.validation.payment_method_required'),
            'payment_method.in' => __('messages.validation.payment_method_in'),
            'original_invoice_number.required_if' => __('messages.validation.original_invoice_number_required_if'),
            'original_invoice_number.exists' => __('messages.validation.original_invoice_number_exists'),
            'total.required' => __('messages.validation.total_required'),
            'total.numeric' => __('messages.validation.total_numeric'),
            'total.min' => __('messages.validation.total_min'),
            'discount.required' => __('messages.validation.discount_required'),
            'discount.numeric' => __('messages.validation.discount_numeric'),
            'discount.min' => __('messages.validation.discount_min'),
            'tax_table.required' => __('messages.validation.tax_table_required'),
            'tax_table.numeric' => __('messages.validation.tax_table_numeric'),
            'tax_table.min' => __('messages.validation.tax_table_min'),
            'tax_additional.required' => __('messages.validation.tax_additional_required'),
            'tax_additional.numeric' => __('messages.validation.tax_additional_numeric'),
            'tax_additional.min' => __('messages.validation.tax_additional_min'),
            'net_amount.required' => __('messages.validation.net_amount_required'),
            'net_amount.numeric' => __('messages.validation.net_amount_numeric'),
            'net_amount.min' => __('messages.validation.net_amount_min'),
            'items.required' => __('messages.validation.items_required'),
            'items.array' => __('messages.validation.items_array'),
            'items.min' => __('messages.validation.items_min'),
            'items.*.product_id.required' => __('messages.validation.items_product_id_required'),
            'items.*.product_id.exists' => __('messages.validation.items_product_id_exists'),
            'items.*.category_id.required' => __('messages.validation.items_category_id_required'),
            'items.*.category_id.exists' => __('messages.validation.items_category_id_exists'),
            'items.*.quantity.required' => __('messages.validation.items_quantity_required'),
            'items.*.quantity.integer' => __('messages.validation.items_quantity_integer'),
            'items.*.quantity.min' => __('messages.validation.items_quantity_min'),
            'items.*.selling_unit_price.required' => __('messages.validation.items_selling_unit_price_required'),
            'items.*.selling_unit_price.numeric' => __('messages.validation.items_selling_unit_price_numeric'),
            'items.*.selling_unit_price.min' => __('messages.validation.items_selling_unit_price_min'),
            'items.*.discount.required' => __('messages.validation.items_discount_required'),
            'items.*.discount.numeric' => __('messages.validation.items_discount_numeric'),
            'items.*.discount.min' => __('messages.validation.items_discount_min'),
            'items.*.tax.required' => __('messages.validation.items_tax_required'),
            'items.*.tax.numeric' => __('messages.validation.items_tax_numeric'),
            'items.*.tax.min' => __('messages.validation.items_tax_min'),
            'items.*.total.required' => __('messages.validation.items_total_required'),
            'items.*.total.numeric' => __('messages.validation.items_total_numeric'),
            'items.*.total.min' => __('messages.validation.items_total_min'),
        ];
    }
}