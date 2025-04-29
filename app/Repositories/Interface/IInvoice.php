<?php

namespace App\Repositories\Interface;

interface IInvoice
{
    public function get($query, $limit,$filter);
    public function save($model);
    public function update($model, $data);
    public function getById($id);
    public function getSellingPriceForInvoiceItem($productId, $categoryId);
    public function getInvoiceItemTotal($productId, $categoryId, $quantity);
    public function getInvoiceItemTotalAfterTaxAndDiscount($productId, $categoryId, $quantity, $tax);
    public function changeInvoiceTypeToReturn($invoiceId);

}