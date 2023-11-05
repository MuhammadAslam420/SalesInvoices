<?php

namespace App\Exports;

//use App\Models\Cash;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CashExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    return Transaction::select('transactions.*', 'sales.saleId as sale_id', 'customers.name as customer_name')
        ->join('sales', 'transactions.saleId', '=', 'sales.id')
        ->join('customers', 'sales.customer_id', '=', 'customers.id')
        ->get();
}


    public function headings(): array
    {
        return [
            'ID',
            'SaleID',
            'Transaction Amount',
            'Payment Mode',
            'Detail',
            'Created At',
            'Updated At',
            'Sale Invoice Date',
            'CM ID',
            'Customer',
        ];
    }
}
