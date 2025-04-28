<?php

use Illuminate\Support\Facades\Route;


Route::middleware(["lang", "cors"])->group(function () {
    require __DIR__ . '/product.php';
    require __DIR__ . '/category.php';
    require __DIR__ . '/invoices.php';
});

















