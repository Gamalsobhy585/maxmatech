<?php

namespace App\Repositories\Implementation;

use App\Models\Category;
use App\Repositories\Interface\ICategory;

class CategoryRepository implements ICategory
{
    public function get()
    {
        return Category::all();

    }

   

}
