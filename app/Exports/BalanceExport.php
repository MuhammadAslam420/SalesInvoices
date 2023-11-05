<?php

namespace App\Exports;

//use App\Models\Balance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BalanceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Balance::select('balances.*', 'customers.name as customer_name')
        // ->join('customers', 'balances.customer_id', '=', 'customers.id')
        // ->get();
    }
    public function headings(): array
    {
        return [
            'ID', // Add more column headings based on your Sale model's attributes
            'CustomerID',
            'SalesID',
            'ReceiptID',
            'SaleAmount',
            'Bank',
            'Detail',
            'Sale Remaining Amount',
            'Paid Amount Against Sale',
            'Total Business',
            'Created At',
            'Updated At',
        ];
    }
}
