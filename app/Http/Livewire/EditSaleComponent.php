<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Sale;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditSaleComponent extends Component
{
    use LivewireAlert;
    public $saleId;
    public $total_amount;
    public $advance;

    public $detail;
    public $paid;
    public $remaining;
    public $discount;
    public $customer_id;
    public $type;
    public $sdate;
    public function mount($id)
    {
        $this->saleId = $id;
        $sale = Sale::where('saleId', $this->saleId)->first();
        $this->customer_id = $sale->customer_id;
        $this->saleId = $sale->saleId;
        $this->total_amount = $sale->total_amount;
        $this->advance = $sale->advance;
        $this->detail = $sale->detail;
        $this->paid = $sale->paid;
        $this->discount = $sale->discount;
        $this->remaining = $sale->remaining;
        $this->type = $sale->payment_type;
        $this->sdate = $sale->sale_date;
    }
    public function updateSale()
    {
        try {
            $sale = Sale::where('saleId', $this->saleId)->first();
            $sale->customer_id =  $this->customer_id;
            $sale->saleId =  $this->saleId;
            $sale->total_amount =  $this->total_amount;
            $sale->advance =  $this->advance;
            $sale->detail =  $this->detail;
            $sale->paid =  $this->paid;
            $sale->discount =  $this->discount;
            $sale->remaining =  $this->remaining;
            $sale->payment_type =  $this->type;
            $sale->sale_date =$this->sdate;
            $sale->save();
            $this->alert('success', 'Sale Invoivce Edit');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }
    public function render()
    {
        $customers = Customer::get(['id', 'name']);
        return view('livewire.edit-sale-component', compact('customers'));
    }
}
