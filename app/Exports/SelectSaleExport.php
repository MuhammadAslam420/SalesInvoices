<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SelectSaleExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $start_date;
    public $end_date;
    public $country_id;
    public function __construct($start,$end,$country){
        $this->start_date =$start;
        $this->end_date =$end;
        $this->country_id =$country;
    }
    public function collection()
    {
        $customers = Customer::where('country_id', $this->country_id)->get();
        $customerIds = $customers->pluck('id')->toArray();

        return Sale::whereBetween('created_at', [$this->start_date, $this->end_date])
            ->with('customer')
            ->whereIn('customer_id', $customerIds) // Use the array of customer IDs
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
            'Company',
        ];
    }
}
