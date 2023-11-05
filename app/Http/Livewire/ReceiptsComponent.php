<?php

namespace App\Http\Livewire;

use App\Exports\CashExport;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptsComponent extends Component
{
    protected $listeners = [
        'confirmed',
    ];
    use WithPagination;
    use LivewireAlert;
    public $transaction;
    public $search;
    public $date;
    public $sorting = 'desc';
    public $perpage = 10;
    public function downloadCashes()
    {
        return Excel::download(new CashExport(), 'cashReceipts.xlsx');
    }
    public function delete($id)
    {
        try {
            $this->transaction = Transaction::findorFail($id);
            $sale = Sale::findorFail($this->transaction->saleId);
            $sale->paid -= $this->transaction->amount;
            $sale->remaining += $this->transaction->amount;
            $sale->status = 'Pending';
            $sale->save();
            $this->alert('question', 'Are you sure you want to delete Invoice?', [
                'showConfirmButton' => true,
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmed',
                'showCancelButton' => true,
                'cancelButtonText' => 'No',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'timer' => null,
                'position' => 'center',
            ]);
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }
    public function confirmed()
    {
        try {
            $this->transaction->delete();
            $this->alert('success', 'Invoice deleted successfully.');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function render()
    {
        $transactions = Transaction::search($this->search, $this->date, $this->sorting, $this->perpage);
        return view('livewire.receipts-component', compact('transactions'));
    }
}
