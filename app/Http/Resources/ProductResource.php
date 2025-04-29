<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'unit_price' => $this->unit_price,
            'boxes_per_carton' => $this->boxes_per_carton,
            'units_per_box' => $this->units_per_box,
            'box_price' => $this->box_price,
            'carton_price' => $this->carton_price,

        ];
    }

    public static function collection($resource)
    {
        $collection = parent::collection($resource);
        
        return $collection->additional([
            'pagination' => [
                'total' => $resource->total(),
                'count' => $resource->count(),
                'per_page' => $resource->perPage(),
                'current_page' => $resource->currentPage(),
                'total_pages' => $resource->lastPage(),
                'from' => $resource->firstItem(),
                'to' => $resource->lastItem(),
                'previous_page' => $resource->previousPageUrl(),
                'next_page' => $resource->nextPageUrl(),
                'has_more_pages' => $resource->hasMorePages(),
            ]
        ]);
    }
}