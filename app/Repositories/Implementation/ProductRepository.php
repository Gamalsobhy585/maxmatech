<?php

namespace App\Repositories\Implementation;

use App\Models\Product;
use App\Repositories\Interface\IProduct;

class ProductRepository implements IProduct
{
    public function get($query, $limit, $sort_by = 'id', $sort_direction = 'asc',$filter=null)
    {
        $products = Product
            ::when($query, function ($q) use ($query) {
                return $q->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                });
            })
          
            ->orderBy($sort_by, $sort_direction)
            ->paginate($limit);

        return $products;
    }

}
