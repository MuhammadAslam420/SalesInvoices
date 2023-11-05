<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Sale;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SaleComponent extends Component
{
    protected $listeners = [
        'confirmed',
    ];
    use WithPagination;
    use LivewireAlert;
    public $sale;
    public $search;
    public $sorting ='desc';
    public $sdate;
    public $perpage =10;
    public $scompany;

    public function deleteSale($id)
    {
        try {
            // Set the $sale property to the Sale model to be deleted
            $this->sale = Sale::findOrFail($id);

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
            $this->sale->delete();
            $this->alert('success', 'Invoice deleted successfully.');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function render()
    {
        $sales = Sale::search($this->search,$this->scompany,$this->sdate,$this->sorting,$this->perpage);
        $countries = Country::get(['id','name']);
        return view('livewire.sale-component', compact('sales','countries'));
    }
}
