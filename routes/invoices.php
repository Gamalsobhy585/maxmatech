<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;




Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']);
    Route::post('/', [InvoiceController::class, 'store']);
    Route::get('/{invoice}', [InvoiceController::class, 'show']);
    Route::put('/{invoice}', [InvoiceController::class, 'update']);
    
    Route::post('/calculate-selling-price', [InvoiceController::class, 'getSellingPrice']);
    Route::post('/calculate-item-total', [InvoiceController::class, 'getItemTotal']);
    Route::post('/calculate-item-total-with-tax-discount', [InvoiceController::class, 'getItemTotalAfterTaxAndDiscount']);
    Route::patch('/{invoice}/mark-as-return', [InvoiceController::class, 'changeInvoiceTypeToReturn']);
});
    




?>