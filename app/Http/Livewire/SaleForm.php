<?php

namespace App\Http\Livewire;

use App\Models\Balance;
use App\Models\Customer;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
class SaleForm extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $listeners = [
        'confirmed',
    ];
    public $oldsale;

    public $customer_id;
    public $type;
    public $discount;
    public $amount;
    public $detail;
    public $advance;
    public $saleId;
    public $sdate;

    protected $rules = [
        'customer_id' => ['required'],
        'saleId' => 'required|unique:sales,saleId', // Fix the unique rule syntax.
        'type' => ['required'],
        'amount' => ['required', 'numeric', 'min:0'],
        'sdate'=>'required',// Add numeric and minimum validation for amount.
    ];

    public function addSales()
    {
        $this->validate();

        try {
            $sale = new Sale();
            $sale->customer_id = $this->customer_id;
            $sale->saleId = $this->saleId;
            $sale->payment_type = $this->type;

            // Calculate total_amount, paid, and remaining based on discount and advance.
            $sale->total_amount = $this->amount;
            $sale->paid = $this->advance;
            $sale->remaining = $this->amount - $this->discount - $this->advance;

            $sale->advance = $this->advance;
            $sale->discount = $this->discount;
            $sale->detail = $this->detail;
            $sale->sale_date =$this->sdate;
            $sale->save();

            $this->reset();
            $this->alert('success', 'Sale has been added');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function deleteSale($id)
    {
        try {
            // Set the $sale property to the Sale model to be deleted
            $this->oldsale = Sale::findOrFail($id);

            $this->alert('question', 'Are you sure you want to delete Invoice?', [
                'showConfirmButton' => true,
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmed',
                'showCancelButton' => true,
                'cancelButtonText' => 'No',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'timer' =>null,
                'position' =>'center'
            ]);
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function confirmed()
    {
        try {
            $this->oldsale->delete();
            $this->alert('success', 'Invoice deleted successfully.');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }
    public function render()
    {
        $customers = Customer::get(['id', 'name']);
        $sales = Sale::where('status','Pending')->orderBy('id', 'desc')->paginate(12);
        return view('livewire.sale-form', compact('customers', 'sales'));
    }
}
