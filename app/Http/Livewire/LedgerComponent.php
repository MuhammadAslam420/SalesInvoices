<?php

namespace App\Http\Livewire;

use App\Exports\CustomerSaleExport;
use App\Exports\SalesExport;
use App\Exports\SelectSaleExport;
use App\Models\Country;
use App\Models\Customer;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LedgerComponent extends Component
{
    public $customer_id;
    public $type;
    public $start;
    public $end;
    public $country_id;
    public function downloadCustomerSales()
    {
        return Excel::download(new CustomerSaleExport($this->customer_id), 'customer.xlsx');
    }
    public function downloadSaleBet()
    {
        return Excel::download(new SelectSaleExport($this->start, $this->end, $this->country_id), 'sale_' . $this->start . '.xlsx');
    }
    public function downloadSales()
    {
        return Excel::download(new SalesExport(), 'sales.xlsx');
    }
    public function render()
    {
        $customers = Customer::get(['id', 'name']);
        $countries = Country::get(['id', 'name']);
        return view('livewire.ledger-component', compact('customers', 'countries'));
    }
}
