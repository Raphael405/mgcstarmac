<?php

namespace App\Http\Livewire;

use App\Models\booking;
use App\Models\booking_details;
use App\Models\services;
use App\Models\services_type;
use Livewire\Component;

class SaleShow extends Component
{
    public $from = null;
    public $to = null;
    public $details = [];
    public $type = "";
    public $sales = 0;
    public $service = "";
    public $service_types = [];
    public $bookings;
    public function mount(){
        $this->from = date('Y-m-d');
        $this->to = date('Y-m-d');
        $this->service_types = services_type::all();
    }
    public function render()
    {
        $this->bookings = booking::where('status','Finished')->where('date','<=',$this->to)->where('date','>=',$this->from)->where('reason','like','%'.$this->type.'%')->get();
        $this->details = booking_details::whereIn('services_id',services::whereIn('services_types_id',services_type::where('service_type','like','%'.$this->service.'%')->pluck('id'))->pluck('id'))->where('date','>=',$this->from)->where('date','<=',$this->to)->where('status','Finished')->whereIn('bookings_id', booking::where('reason','like','%'.$this->type.'%')->pluck('id'))->get();
        $this->sales = booking_details::whereIn('services_id',services::whereIn('services_types_id',services_type::where('service_type','like','%'.$this->service.'%')->pluck('id'))->pluck('id'))->where('date','>=',$this->from)->where('date','<=',$this->to)->where('status','Finished')->whereIn('bookings_id', booking::where('reason','like','%'.$this->type.'%')->pluck('id'))->sum('subtotal');
        return view('livewire.sale-show');
    }
}
