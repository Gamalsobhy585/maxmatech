<?php

namespace App\Services;

use App\Repositories\Interface\IProduct;
use App\Services\Interface\IProductService;

use Illuminate\Support\Facades\Log;

class ProductService implements IProductService
{
    private IProduct $Productrepo;

    public function __construct(IProduct $Productrepo)
    {
        $this->Productrepo = $Productrepo;
    }

    public function getProducts($request, $limit)
    {
        try {
            $query = $request->input('query');
            $sort_by = $request->input('sort_by', 'id');
            $filter = $request->input('filter');
            $sort_direction = $request->input('sort_direction', 'asc');

            return $this->Productrepo->get($query, $limit, $sort_by, $sort_direction, $filter);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

}
