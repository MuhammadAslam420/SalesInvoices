<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    public function collection()
    {

            return Sale::with('customer')
                ->get()
                ->map(function ($sale) {
                    $data = $sale->toArray();
                    $data['customer'] = $sale->customer->name;
                    $data['country'] = $sale->customer->country->name;// Include the customer's name in the data
                    return $data;
                });
    }

    public function headings(): array
    {
        return [
            'ID',
            'SaleId', // Add more column headings based on your Sale model's attributes
            'CustomerID',
            'Type',
            'Total Amount',
            'Discount',
            'Detail',
            'Advance',
            'Paid',
            'Remaining',
            'Status',
            'Created At',
            'Updated At',
            'Sale Invoice Date',
            'Customer',
            'Company'
        ];
    }
}

