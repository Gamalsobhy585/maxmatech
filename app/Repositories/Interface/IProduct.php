<?php

namespace App\Repositories\Interface;

interface IProduct
{
    public function get($query, $limit, $sort_by = null, $sort_direction = 'asc',$filter);

}
