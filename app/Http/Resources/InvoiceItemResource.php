<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'product_id' => $this->product_id,
            'category_id' => $this->category_id,
            'quantity' => $this->quantity,
            'selling_unit_price' => $this->selling_unit_price,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'total' => $this->total,
            'product' => new ProductItemResource($this->whenLoaded('product')),
            'category' => new CategoryResource($this->whenLoaded('category')),

        ];
    }
}
