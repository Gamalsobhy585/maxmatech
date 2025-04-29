<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'unit_price' => $this->unit_price,
            'boxes_per_carton' => $this->boxes_per_carton,
            'units_per_box' => $this->units_per_box,
            'box_price' => $this->box_price,
            'carton_price' => $this->carton_price,

        ];
    }

   
}