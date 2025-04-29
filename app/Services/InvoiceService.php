<?php
namespace App\Services;


use App\Repositories\Interface\IInvoice;
use App\Services\Interface\IInvoiceService;
use Illuminate\Support\Facades\Log;

class InvoiceService implements IInvoiceService
{
    private IInvoice $invoicerepo;

    public function __construct(IInvoice $invoicerepo)
    {
        $this->invoicerepo = $invoicerepo;
    }

    public function getInvoices($request,$limit)
    {
        try {
            $query = $request->input('query');
            $filter = $request->input('filter');
            return $this->invoicerepo->get($query, $limit, $filter);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function save($request)
    {
        try {
            $data = [
                'invoice' => [
                    'invoice_number' => $this->generateInvoiceNumber(),
                    'type' => $request->type,
                    'payment_method' => $request->payment_method,
                    'original_invoice_number' => $request->original_invoice_number,
                    'total' => $request->total,
                    'discount' => $request->discount,
                    'tax_table' => $request->tax_table,
                    'tax_additional' => $request->tax_additional,
                    'net_amount' => $request->net_amount,
                ],
                'items' => $request->items
            ];
            
            return $this->invoicerepo->save($data);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
    
    public function update($request, $invoice)
    {
        try {
            $data = [
                'invoice' => [
                    'type' => 3,
                    'payment_method' => $request->payment_method,
                    'original_invoice_number' => $request->original_invoice_number,
                    'total' => $request->total,
                    'discount' => $request->discount,
                    'tax_table' => $request->tax_table,
                    'tax_additional' => $request->tax_additional,
                    'net_amount' => $request->net_amount,
                ],
                'items' => $request->items
            ];
            
            return $this->invoicerepo->update($invoice, $data);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            return $this->invoicerepo->getById($id);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
    public function getSellingPriceForInvoiceItem($productId, $categoryId)
    {
        try {
            return $this->invoicerepo->getSellingPriceForInvoiceItem($productId, $categoryId);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
    
    public function getInvoiceItemTotal($productId, $categoryId, $quantity)
    {
        try {
            return $this->invoicerepo->getInvoiceItemTotal($productId, $categoryId, $quantity);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
    
    public function getInvoiceItemTotalAfterTaxAndDiscount($productId, $categoryId, $quantity, $tax, $discount = 0)
    {
        try {
            return $this->invoicerepo->getInvoiceItemTotalAfterTaxAndDiscount($productId, $categoryId, $quantity, $tax, $discount);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
    

    private function generateInvoiceNumber()
    {
        $prefix = 'INV';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        
        return $prefix . '-' . $date . '-' . $random;
    }
    public function changeInvoiceStatusToReturn($invoiceId)
    {
        try {
            return $this->invoicerepo->changeInvoiceTypeToReturn($invoiceId);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}

