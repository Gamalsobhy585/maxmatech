<?php

namespace App\Services\Interface;

interface IInvoiceService
{
    public function getInvoices($request,$limit);
    public function save($request);
    public function update($request,$id);
    public function getById($id);
    public function getSellingPriceForInvoiceItem($productId, $categoryId);
    public function getInvoiceItemTotal($productId, $categoryId, $quantity);
    public function getInvoiceItemTotalAfterTaxAndDiscount($productId, $categoryId, $quantity, $tax);
    public function changeInvoiceStatusToReturn($invoiceId);

    
}