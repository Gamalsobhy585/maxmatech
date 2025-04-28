<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Traits\ResponseTrait;
use App\Services\Interface\IProductService;


use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ResponseTrait;
    protected IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        try {
            $products = $this->productService->getProducts($request, $request->get("per_page", 10));
            return $this->returnDataWithPagination(
                __('messages.product.get_all'),
                200,
                ProductResource::collection($products)
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.product.get_failed'), 500);
        }
    }

   
}