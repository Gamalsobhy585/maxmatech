<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit_price', 'boxes_per_carton', 'units_per_box'];
    
    /**
     * Get the box price (unit_price * units_per_box).
     */
    public function getBoxPriceAttribute()
    {
        return $this->unit_price * ($this->units_per_box ?? 1);
    }

    /**
     * Get the carton price (box_price * boxes_per_carton).
     */
    public function getCartonPriceAttribute()
    {
        $boxPrice = $this->box_price;
        return $boxPrice * ($this->boxes_per_carton ?? 1);
    }
}