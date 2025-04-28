<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Services\Interface\ICategoryService;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Log;




class CategoryController extends Controller
{
    use ResponseTrait;
    protected ICategoryService $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        try {
            $categories = $this->categoryService->getCategories($request);
            return $this->returnData(
                __('messages.category.get_all'),
                200,
                CategoryResource::collection($categories)
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             $this->returnError(__('messages.category.get_failed'), 500);
        }
    }


  
}