<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CompanyComponent extends Component
{
    protected $listeners = [
        'confirmed',
    ];
    use LivewireAlert;
    public $company;
    public $companyId;

    public $isEditing = false;
    public $country;
    protected $rules = [
        'company' => 'required|string|max:255|unique:countries,name',
    ];
    public function create()
    {
        $this->resetValidation();
        $this->reset();
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $company = Country::findOrFail($id);
        $this->companyId = $company->id; // Set the companyId property
        $this->company = $company->name;
        $this->isEditing = true; // Set isEditing to true to indicate editing mode
    }


    public function save()
{
    $this->validate();

    try {
        if ($this->isEditing) {
            $company = Country::findOrFail($this->companyId);
            $company->update([
                'name' => $this->company, // Corrected the variable name here
            ]);
        } else {
            Country::create([
                'name' => $this->company, // Corrected the variable name here
            ]);
        }
        $this->alert('success', 'SuccessOk');
        $this->resetValidation();
        $this->reset();
        $this->isEditing = false;
    } catch (\Exception $e) {
        return $this->alert('error', $e->getMessage());
    }
}


public function delete($id)
{
    try {
        // Set the $sale property to the Sale model to be deleted
        $this->country = Country::findOrFail($id);

        $this->alert('question', 'Are you sure you want to delete Company?', [
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
        $this->country->delete();
        $this->alert('success', 'Company deleted successfully.');
    } catch (\Exception $e) {
        $this->alert('error', $e->getMessage());
    }
}
    public function render()
    {
        $companies = Country::get(['id', 'name', 'created_at']);
        return view('livewire.company-component', compact('companies'));
    }
}
