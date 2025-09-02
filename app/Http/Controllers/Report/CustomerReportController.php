<?php

namespace App\Http\Controllers\Report;

use App\Exports\CustomerReportExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Excel;

class CustomerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->has('export') && $request->export == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(
                new CustomerReportExport($request->customer_id, $request->date_range),
                'customer_report.xlsx'
            );
        }


        $query = Customer::with(['orders.items']);

        // 🔹 Filter by customer
        if ($request->filled('customer_id') && $request->customer_id != 'all') {
            $query->where('id', $request->customer_id);
        }

        $customers = $query->get()->map(function ($customer, $index) use ($request) {
            $orders = $customer->orders;

            // 🔹 Filter by date range
            if ($request->filled('date_range')) {
                [$start, $end] = explode(' - ', $request->date_range);
                $startDate = Carbon::createFromFormat('d/m/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('d/m/Y', trim($end))->endOfDay();

                $orders = $orders->whereBetween('created_at', [$startDate, $endDate]);
            }

            return [
                'reference' => 'INV' . date('Y') . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'code' => 'CU' . str_pad($customer->id, 3, '0', STR_PAD_LEFT),
                'name' => $customer->first_name . ' ' . $customer->last_name,
                'image' => $customer->image,
                'total_orders' => $orders->sum(function ($order) {
                    return $order->items->sum('qty');
                }),
                'amount' => $orders->sum('total'),
            ];
        });

        $grandTotal = $customers->sum('amount');
        $allCustomers = Customer::select('id', 'first_name', 'last_name')->get();

        return view('report.customer-report', compact('customers', 'grandTotal', 'allCustomers', 'request'));


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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
