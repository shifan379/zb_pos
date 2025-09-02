<?php

namespace App\Exports;

use App\Models\Supplier;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     protected $supplierId;
    protected $dateRange;

    public function __construct($supplierId = null, $dateRange = null)
    {
        $this->supplierId = $supplierId;
        $this->dateRange = $dateRange;
    }

    public function collection()
    {
        $query = Supplier::with(['purchases.items']);

        if ($this->supplierId && $this->supplierId != 'all') {
            $query->where('id', $this->supplierId);
        }

        $suppliers = $query->get()->map(function ($supplier, $index) {
            $purchases = $supplier->purchases;

            if ($this->dateRange) {
                [$start, $end] = explode(' - ', $this->dateRange);
                $startDate = Carbon::createFromFormat('d/m/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('d/m/Y', trim($end))->endOfDay();
                $purchases = $purchases->whereBetween('purchase_date', [$startDate, $endDate]);
            }

            return [
                'Reference' => 'PO' . date('Y') . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'Supplier Code' => 'SU' . str_pad($supplier->id, 3, '0', STR_PAD_LEFT),
                'Name' => $supplier->name,
                'Total Items' => $purchases->sum(function ($purchase) {
                    return $purchase->items->sum('qty');
                }),
                'Amount' => $purchases->sum('total'),
            ];
        });

        return collect($suppliers);
    }

    public function headings(): array
    {
        return ['Reference', 'Supplier Code', 'Name', 'Total Items', 'Amount'];
    }
}
