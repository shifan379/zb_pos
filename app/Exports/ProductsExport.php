<?php

namespace App\Exports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class ProductsExport implements FromCollection, WithHeadings
{

    protected $ids;
    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return product::whereIn('id', $this->ids)
            ->select('item_code','location', 'product_name', 'buying_price','selling_price', 'discount_amount', 'unit', 'quantity')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Item Code',
            'Location',
            'Product Name',
            'Buying Price',
            'Selling Price',
            'Discount',
            'Unit',
            'Quantity',
        ];
    }
}
