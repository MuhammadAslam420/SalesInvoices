<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $name;
    public $logo;
    public $email;
    public $address;
    public $phone;
    public $notes;
    public $new_logo;
    public $settingId;

    public function mount()
    {
        $setting = Setting::find(1);
      if($setting){
        $this->name= $setting->name;
        $this->logo= $setting->logo;
        $this->email= $setting->email;
        $this->address= $setting->address;
        $this->phone= $setting->phone;
        $this->notes= $setting->notes;
      }else{
        $setting = new Setting();
        $setting->save();
      }
    }
    public function updateSetting()
    {
        try{
          $setting = Setting::find(1);
          $setting->name =  $this->name;
          $setting->email =  $this->email;
          $setting->address =  $this->address;
          $setting->phone =  $this->phone;
          $setting->notes =  $this->notes;
          if($this->new_logo){
            $image = Carbon::now()->timestamp.'.'.$this->new_logo->extension();
            $this->new_logo->storeAs('images',$image);
            $setting->logo = $image;
          }
          $setting->save();
        $this->alert('success','Setting has been Updated');
        }catch(\Exception $e){
            $this->alert('error',$e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.setting-component');
    }
}
