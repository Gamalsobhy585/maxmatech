<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Category;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $categories = Category::all();
        
        if ($products->isEmpty() || $categories->isEmpty()) {
            $this->command->info('No products or categories found. Please run ProductSeeder and CategorySeeder first.');
            return;
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $invoice = Invoice::create([
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'type' => rand(1, 3),
                'payment_method' => rand(0, 1) ? 'cash' : 'credit',
                'original_invoice_number' => null, 
                'total' => 0, 
                'discount' => rand(0, 100),
                'tax_table' => 14, 
                'tax_additional' => rand(0, 5),
                'net_amount' => 0, 
            ]);
            
            $itemCount = rand(1, 5);
            $invoiceTotal = 0;
            
            for ($j = 1; $j <= $itemCount; $j++) {
                $product = $products->random();
                $category = $categories->random();
                
                $sellingPrice = 0;
                
                switch ($category->name) {
                    case 'Box':
                        $sellingPrice = $product->unit_price * $product->units_per_box;
                        break;
                    case 'Carton':
                        $sellingPrice = $product->unit_price * $product->units_per_box * $product->boxes_per_carton;
                        break;
                    case 'Piece':
                    default:
                        $sellingPrice = $product->unit_price;
                        break;
                }
                
                $quantity = rand(1, 10);
                $discount = rand(0, 50);
                $tax = 14; 
                
                $subtotal = $sellingPrice * $quantity;
                $afterDiscount = $subtotal - $discount;
                $total = $afterDiscount + ($afterDiscount * $tax / 100);
                
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'category_id' => $category->id,
                    'quantity' => $quantity,
                    'selling_unit_price' => $sellingPrice,
                    'discount' => $discount,
                    'tax' => $tax,
                    'total' => $total,
                ]);
                
                $invoiceTotal += $total;
            }
            
            $afterDiscount = $invoiceTotal - $invoice->discount;
            $afterTax = $afterDiscount + ($afterDiscount * ($invoice->tax_table + $invoice->tax_additional) / 100);
            
            $invoice->update([
                'total' => $invoiceTotal,
                'net_amount' => $afterTax
            ]);
        }
    }
}