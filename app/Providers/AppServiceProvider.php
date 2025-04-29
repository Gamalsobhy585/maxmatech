<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\IProduct;
use App\Repositories\Implementation\ProductRepository;
use App\Repositories\Interface\ICategory;
use App\Repositories\Implementation\CategoryRepository;
use App\Repositories\Implementation\InvoiceRepository;
use App\Repositories\Interface\IInvoice;
use App\Services\Interface\IInvoiceService;
use App\Services\Interface\IProductService;
use App\Services\Interface\ICategoryService;
use App\Services\InvoiceService;
use App\Services\ProductService;
use App\Services\CategoryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app->bind(IProduct::class, ProductRepository::class);
        $this->app->bind(ICategory::class, CategoryRepository::class);
        $this->app->bind(IInvoice::class,InvoiceRepository::class);
        $this->app->bind(IInvoiceService::class,InvoiceService::class);
        $this->app->bind(IProductService::class,ProductService::class);
        $this->app->bind(ICategoryService::class,CategoryService::class);
    

    }

    /**
     * Bootstrap any Application services.
     */
    public function boot()
    {
        //
    }
}
