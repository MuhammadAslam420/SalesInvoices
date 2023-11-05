<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Collection;
use DB;
class CustomerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    // ...

    public function collection()
    {
        return Customer::with('sales')
        ->get(['id','name','email','contact_number','address'])
        ->map(function ($customer) {
            $data = $customer;
            $data['remaining'] = $customer->sales->sum('remaining');
            $data['paid'] = $customer->sales->sum('paid');
            $data['amount'] = $customer->sales->sum('total_amount');
            return $data;
        });

    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Contact',
            'Address',
            'Pending Amount',
            'Paid Amount',
            'Total Amount',

        ];
    }
}
