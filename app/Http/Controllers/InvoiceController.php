<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\Interface\IInvoiceService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\InvoiceResource;
use App\Http\Requests\GetItemTotalAfterTaxAndDiscountRequest;
use App\Http\Requests\GetSellingPriceRequest;
use App\Http\Requests\GetItemTotalRequest;


class InvoiceController extends Controller
{
    use ResponseTrait;
    protected IInvoiceService $invoiceService;

    public function __construct(IInvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(Request $request)
    {
        try {
            $invoices = $this->invoiceService->getInvoices($request, $request->get("per_page", 10));
            return $this->returnDataWithPagination(
                __('messages.invoice.get_all'),
                200,
                InvoiceResource::collection($invoices)
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->returnError(__('messages.invoice.get_failed'), 500);
        }
    }

 
    public function store(StoreInvoiceRequest $request)
    {
        try {
            $invoice = $this->invoiceService->save($request);
            return $this->returnData(
                __('messages.invoice.create'),
                200,
                new InvoiceResource($invoice)
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->returnError(__('messages.invoice.create_failed'), 500);
        }
    }

 
    public function show(Invoice $invoice)
    {
        try 
        {
           
            
            return $this->returnData(
                __('messages.invoice.get'),
                200,
                new InvoiceResource($invoice)
            );
        } 
        catch (\Throwable $e)
        {
            Log::error($e->getMessage());
            $this->returnError(__('messages.invoice.get_failed'), 500);
        }
    }


    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        try {
            $invoice = $this->invoiceService->update($request, $invoice);
            return $this->returnData(
                __('messages.invoice.update'),
                200,
                new InvoiceResource($invoice)
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->returnError(__('messages.invoice.update_failed'), 500);
        }
    }

    public function getSellingPrice(GetSellingPriceRequest $request)
    {
        try {
            $price = $this->invoiceService->getSellingPriceForInvoiceItem(
                $request->product_id,
                $request->category_id
            );
            
            return $this->returnData(
                __('messages.invoice.price_calculated'),
                200,
                ['selling_price' => $price]
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->returnError(__('messages.invoice.calculation_failed'), 500);
        }
    }

    public function getItemTotal(GetItemTotalRequest $request)
    {
        try {
            $total = $this->invoiceService->getInvoiceItemTotal(
                $request->product_id,
                $request->category_id,
                $request->quantity
            );
            
            return $this->returnData(
                __('messages.invoice.total_calculated'),
                200,
                ['total' => $total]
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->returnError(__('messages.invoice.calculation_failed'), 500);
        }
    }

    public function getItemTotalAfterTaxAndDiscount(GetItemTotalAfterTaxAndDiscountRequest $request)
    {
        try {
            $total = $this->invoiceService->getInvoiceItemTotalAfterTaxAndDiscount(
                $request->product_id,
                $request->category_id,
                $request->quantity,
                $request->tax,
                $request->discount
            );
            
            return $this->returnData(
                __('messages.invoice.total_calculated'),
                200,
                ['total' => $total]
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->returnError(__('messages.invoice.calculation_failed'), 500);
        }
    }
    
    public function changeInvoiceTypeToReturn(Invoice $invoice)
    {
        try {
            $this->invoiceService->changeInvoiceStatusToReturn($invoice->id);
            
            return $this->success(
                __('messages.invoice.marked_as_return'),
                200
            );
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->returnError(
                __('messages.invoice.mark_failed'),
                500
            );
        }
    }

 
}
