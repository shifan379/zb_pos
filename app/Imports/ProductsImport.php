<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel, WithHeadingRow, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Start reading from row 2 (skip "Export Items")
    }

    public function model(array $row)
    {
        // Debug: Log the row keys
        Log::info('Importing row:', $row);
        // Check for required fields
        if (!isset($row['product_name']) || empty(trim($row['product_name']))) {
            return null;
        }
        return new Product([
            'product_name' => trim($row['product_name']),
            'item_code' => $row['item_code'] ?? null,
            'selling_price' => $row['selling_price'] ? (float) $row['selling_price'] : 0,
            'buying_price' => $row['buying_price'] ? (float) $row['buying_price'] : 0,
            'discount_percentage' => 0.00,
            'quantity' => $row['quantity'] ?? 0,
            'quantity_alert' => 5,
            'unit' => 'pcs',
            'location' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
