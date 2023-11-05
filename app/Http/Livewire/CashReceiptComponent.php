<?php

namespace App\Http\Livewire;

use App\Exports\CashExport;
use App\Exports\CustomerExport;
use App\Exports\SalesExport;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class CashReceiptComponent extends Component
{
    use LivewireAlert;
    public $customer_id;
    public $sale_id;
    public $amount;
    public $type;
    public $date;

    public $note;
    public $selectedCustomerId;
    public $salesInfo = [];
    public $balance;

    protected $rules = [
        'customer_id' => ['required'],
        'sale_id' => ['required'],
        'amount' => ['required'],
        'type' => ['required'],
        'note' => ['required'],
    ];

    // Method to handle the customer selection
    public function addReceipt()
    {
        $this->validate();

        $sale = Sale::where('saleId', $this->sale_id)->where('remaining', '>=', $this->amount)->first();

        if ($sale) {
            try {
                $transaction = new Transaction();
                $transaction->saleId = $sale->id;
                $transaction->amount = $this->amount;
                $transaction->ptype = $this->type;
                $transaction->detail = $this->note;
                $sale->remaining -= $this->amount; // Adjust remaining balance.
                $sale->paid += $this->amount;

                if ($sale->remaining === 0) {
                    $sale->status = 'Closed'; // Use strict comparison '===' for better accuracy.
                } elseif ($sale->remaining > 0) {
                    $sale->status = 'Partial-pending';
                } else {
                    // Handle potential edge case where 'remaining' becomes negative (overpayment).
                    // You may decide how to handle this case depending on your business rules.
                    // For example, you could set the 'status' to 'Overpaid' or 'Completed'.
                    $sale->status = 'Completed'; // Customize this according to your requirements.
                }

                $transaction->save();
                $transaction->sale_date =$this->date;
                $sale->save();
                $this->updatedSelectedCustomerId($this->customer_id);
                $this->alert('success', 'Receipt has been added');

            } catch (\Exception $e) {
                $this->alert('error', $e->getMessage());
            }
        } else {
            $this->alert('error', 'Please select the correct user, sale id, or amount');
        }
    }
    public function updatedSelectedCustomerId($value)
    {
        $this->reset();
        $this->customer_id = $value;
        $sales = Sale::where('customer_id', $this->customer_id)->where('remaining','>',0)->get();

        $this->salesInfo = $sales;
        $this->balance= Sale::where('customer_id',$this->customer_id)->sum('remaining');

    }


    public function downloadSales()
    {
        return Excel::download(new SalesExport(), 'sales.xlsx');
    }
    public function downloadCashes()
    {
        return Excel::download(new CashExport(), 'cashReceipts.xlsx');
    }
    public function downloadCustomers()
    {
        return Excel::download(new CustomerExport(), 'customers.xlsx');
    }
    // public function downloadBalances()
    // {
    //     return Excel::download(new BalanceExport(), 'balnce_sheet.xlsx');
    // }
    public function render()
    {
        $customers = Customer::get(['id', 'name']);
        $countries = Country::get(['id','name']);
        return view('livewire.cash-receipt-component', compact('customers','countries'));
    }
}
