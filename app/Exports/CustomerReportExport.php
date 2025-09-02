<?php

namespace App\Exports;

use App\Models\Customer;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerReportExport implements FromCollection, WithHeadings
{

    protected $customerId;
    protected $dateRange;

    public function __construct($customerId = null, $dateRange = null)
    {
        $this->customerId = $customerId;
        $this->dateRange = $dateRange;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Customer::with(['orders.items']);

        if ($this->customerId && $this->customerId != 'all') {
            $query->where('id', $this->customerId);
        }

        $customers = $query->get()->map(function ($customer, $index) {
            $orders = $customer->orders;

            // Filter by date range
            if ($this->dateRange) {
                [$start, $end] = explode(' - ', $this->dateRange);
                $startDate = Carbon::createFromFormat('d/m/Y', trim($start))->startOfDay();
                $endDate = Carbon::createFromFormat('d/m/Y', trim($end))->endOfDay();
                $orders = $orders->whereBetween('created_at', [$startDate, $endDate]);
            }

            return [
                'Reference' => 'INV' . date('Y') . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'Customer Code' => 'CU' . str_pad($customer->id, 3, '0', STR_PAD_LEFT),
                'Name' => $customer->first_name . ' ' . $customer->last_name,
                'Total Orders' => $orders->sum(function ($order) {
                    return $order->items->sum('qty');
                }),
                'Total Amount' => $orders->sum('total'),
            ];
        });

        return collect($customers);
    }

    public function headings(): array
    {
        return ['Reference', 'Customer Code', 'Name', 'Total Orders', 'Total Amount'];
    }

}
