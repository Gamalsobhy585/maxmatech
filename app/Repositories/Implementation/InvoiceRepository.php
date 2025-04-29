<?php

namespace App\Repositories\Implementation;

use App\Models\Invoice;
use App\Repositories\Interface\IInvoice;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class InvoiceRepository implements IInvoice
{
    public function get($query, $limit, $filter)
    {
        return Invoice::with(['items.product', 'items.category']) 
            ->when($query, function ($q) use ($query) {
                return $q->where(function ($q) use ($query) {
                    $q->where('invoice_number', 'like', "%{$query}%");
                      
                });
            })
            ->when($filter, function ($q) use ($filter) {
                $types = [
                    'sale' => 1,
                    'return' => 2,
                    'exchange' => 3,
                ];
                
                $paymentTypes = [
                    'cash' => 'cash',
                    'credit' => 'credit'
                ];
                
                if (array_key_exists($filter, $types)) {
                    return $q->where('type', $types[$filter]);
                }
                
                if (array_key_exists($filter, $paymentTypes)) {
                    return $q->where('payment_method', $paymentTypes[$filter]);
                }
                
                return $q;
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    public function save($model)
    {
        DB::beginTransaction();
        
        try {
            $invoice = Invoice::create($model['invoice']);
            
            foreach ($model['items'] as $item) {
                $item['invoice_id'] = $invoice->id;
                $invoice->items()->create($item);
            }
            
            DB::commit();
            return $invoice->load('items.product');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function update($model, $data)
    {
        DB::beginTransaction();
        
        try {
            $model->update($data['invoice']);
    
            $model->items()->delete();
    
            foreach ($data['items'] as $item) {
                $model->items()->create($item);
            }
    
            DB::commit();
            return $model->load('items.product');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function getById($id)
    {
        return Invoice::find($id);
    }
    public function getSellingPriceForInvoiceItem($productId, $categoryId)
    {
        $product = Product::findOrFail($productId);
        $category = Category::findOrFail($categoryId);
        
        switch ($category->name) {
            case 'Box':
                return $product->box_price;
            case 'Carton':
                return $product->carton_price;
            case 'Piece':
            default:
                return $product->unit_price;
        }
    }
    
    public function getInvoiceItemTotal($productId, $categoryId, $quantity)
    {
        $price = $this->getSellingPriceForInvoiceItem($productId, $categoryId);
        return $price * $quantity;
    }
    
    public function getInvoiceItemTotalAfterTaxAndDiscount($productId, $categoryId, $quantity, $tax, $discount = 0)
    {
        $subtotal = $this->getInvoiceItemTotal($productId, $categoryId, $quantity);
        $afterDiscount = $subtotal - $discount;
        $total = $afterDiscount + ($afterDiscount * $tax / 100);
        
        return $total;
    }

    public function changeInvoiceTypeToReturn($invoiceId)
    {
        return Invoice::where('id', $invoiceId)
        ->update(['type' => 2]);
    }
}