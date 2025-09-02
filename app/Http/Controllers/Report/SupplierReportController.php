<?php

namespace App\Http\Controllers\Report;

use App\Exports\SupplierReportExport;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SupplierReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Excel export
        if ($request->has('export') && $request->export == 'excel') {
            return Excel::download(
                new SupplierReportExport($request->supplier_id, $request->date_range),
                'supplier_report.xlsx'
            );
        }

        $query = Supplier::with(['purchases.items'])
            ->whereHas('purchases', function ($q) use ($request) {
                if ($request->filled('date_range')) {
                    [$start, $end] = explode(' - ', $request->date_range);
                    $startDate = Carbon::createFromFormat('d/m/Y', trim($start))->startOfDay();
                    $endDate = Carbon::createFromFormat('d/m/Y', trim($end))->endOfDay();

                    $q->whereBetween('purchase_date', [$startDate, $endDate]);
                }
            });

        if ($request->filled('supplier_id') && $request->supplier_id != 'all') {
            $query->where('id', $request->supplier_id);
        }

        $suppliers = $query->get()->map(function ($supplier, $index) use ($request) {
            $purchases = $supplier->purchases;

            if ($request->filled('date_range')) {
                [$start, $end] = explode(' - ', $request->date_range);
                $startDate = Carbon::createFromFormat('d/m/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('d/m/Y', trim($end))->endOfDay();

                $purchases = $purchases->whereBetween('purchase_date', [$startDate, $endDate]);
            }

            return [
                'reference' => 'PO' . date('Y') . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'supplier_code' => 'SU' . str_pad($supplier->id, 3, '0', STR_PAD_LEFT),
                'name' => $supplier->company_name,
                'image' => $supplier->image,
                'total_items' => $purchases->sum(function ($purchase) {
                    return $purchase->items->sum('qty');
                }),
                'amount' => $purchases->sum('total'),
            ];
        });

        // Remove any suppliers that have 0 purchases after filtering
        $suppliers = $suppliers->filter(fn($s) => $s['total_items'] > 0);

        // Alert if no data available  // Alert Not working need to check
        if ($suppliers->isEmpty()) {
            return redirect()->back()->with('alert', 'No data available for the selected filter');
        }


        $grandTotal = $suppliers->sum('amount');
        $allSuppliers = Supplier::select('id', 'company_name')->get();

        return view('report.supplier-report', compact('suppliers', 'grandTotal', 'allSuppliers', 'request'));

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
