<?php

namespace App\Exports;
use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerSaleExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $customer;


    public function __construct($customer)
    {
        $this->customer = $customer;

    }
    public function collection()
    {
        return $sales = Sale::where('customer_id',$this->customer)->get();
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
        ];
    }
}
