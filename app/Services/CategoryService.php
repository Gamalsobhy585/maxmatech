<?php

namespace App\Services;

use App\Repositories\Interface\ICategory;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Cache;

use App\Services\Interface\ICategoryService;

class CategoryService implements ICategoryService
{
    private ICategory $Categoryrepo;

    public function __construct(ICategory $Categoryrepo)
    {
        $this->Categoryrepo = $Categoryrepo;
    }

    public function getCategories($request)
    {
        try {
            $cacheKey = 'categories:all';
            
            return Cache::remember($cacheKey, now()->addHours(24), function() {
                $categories = $this->Categoryrepo->get();
                return CategoryResource::collection($categories);
            });
            
        } catch (\Exception $e) {
            Log::error('Failed to get categories: ' . $e->getMessage());
            throw new \Exception(__('messages.category.fetch_failed'), 500);
        }
    }

 


}
