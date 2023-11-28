<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\InvoicesFilter;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoices;
use App\Http\Requests\StoreInvoicesRequest;
use App\Http\Requests\UpdateInvoicesRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;
use App\Http\Resources\V1\InvoiceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoicesController extends Controller
{


    public function index(Request $request)
    {
        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {

            return new InvoiceCollection(Invoices::paginate());
        } else {
           $invoices = Invoices::where($queryItems)->paginate();

           return new InvoiceCollection($invoices->appends($request->query()));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoicesRequest $request)
    {
        //
    }

    public function  bulkStore(BulkStoreInvoiceRequest $request)
    {
        $bulk = collect($request->all())->map(function ($arr, $key) {
            return Arr::except($arr, ['customerId', 'billedDated', 'paidDated']);
        });

        Invoices::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoicesRequest $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices $invoices)
    {
        //
    }
}
