<?php

namespace App\Http\Livewire;

use App\Exports\CustomerExport;
use App\Models\Country;
use App\Models\Customer;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CustomerComponent extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;
    public $customerId;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $image;
    public $new_image;
    public $country_id;

    public $isEditing = false;
    public $search;
    public $perPage= 12;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'country_id'=>'required',
    ];
    public function downloadCustomers()
    {
        return Excel::download(new CustomerExport(), 'customers.xlsx');
    }
    public function create()
    {
        $this->resetValidation();
        $this->reset();
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $customer = Customer::findOrFail($id);
        $this->country_id = $customer->country_id;
        $this->customerId = $customer->id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->contact_number;
        $this->address = $customer->address;
        $this->isEditing = true;
    }

    public function save()
    {
        $this->validate();

        try{
            if ($this->isEditing) {
                $customer = Customer::findOrFail($this->customerId);
                $image = $customer->picture;
                if($this->image){

                    $image=Carbon::now()->timestamp.'.'.$this->image->extension();
                    $this->image->storeAs('/images',$image);
                }
                $customer->update([
                    'country_id'=>$this->country_id,
                    'name' => $this->name,
                    'email' => $this->email,
                    'contact_number' => $this->phone,
                    'address' => $this->address,
                    'picture' => $image,
                ]);
            } else {
                if($this->image){
                    $image=Carbon::now()->timestamp.'.'.$this->image->extension();
                    $this->image->storeAs('/images',$image);
                }
                Customer::create([
                    'country_id'=>$this->country_id,
                    'name' => $this->name,
                    'email' => $this->email,
                    'contact_number' => $this->phone,
                    'address' => $this->address,
                    'picture' => $image,
                ]);
            }
            $this->alert('success','SuccessOk');
            $this->resetValidation();
            $this->reset();
            $this->isEditing = false;
        }catch(\Exception $e){
            return $this->alert('error',$e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            Customer::findOrFail($id)->delete();
            $this->alert('success','Customer Deleted');
        }catch(\Exception $e)
        {
            return $this->alert('error',$e->getMessage());
        }
    }
    public function render()
    {
        $customers = Customer::search($this->search,$this->perPage);
        $countries = Country::get();
        return view('livewire.customer-component',compact('customers','countries'));
    }
}
