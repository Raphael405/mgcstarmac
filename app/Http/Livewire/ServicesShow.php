<?php

namespace App\Http\Livewire;

use App\Models\services;
use App\Models\services_images;
use App\Models\services_type;
use Livewire\Component;

class ServicesShow extends Component
{
    public $filter = "All";
    public $services;
    public $types;
    public $type = "";
    
    public function mount(){
        
        $this->types = services_type::all();
        $this->services = services::where('name','not like', '%Package%')->get();
    }
    public function render()
    {
        return view('livewire.services-show');
    }
    public function sort(){
        if($this->filter === "All"){
            $this->services = services::where('name','not like', '%Package%')->get();
        }
        else{
            $this->services = services::where('services_types_id',$this->filter)->where('name','not like', '%Package%')->get();
        }
    }
    public function remove($id){
        $image = services_images::find($id);
        $image->delete();
    }
}
