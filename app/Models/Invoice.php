<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'type',
        'payment_method',
        'original_invoice_number',
        'total',
        'discount',
        'tax_table',
        'tax_additional',
        'net_amount',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    
    public function getTypeTextAttribute(): string
    {
        $types = [
            1 => 'sale',
            2 => 'return',
            3 => 'exchange'
        ];

        return $types[$this->type] ?? 'unknown';
    }
}
