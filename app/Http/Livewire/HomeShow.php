<?php

namespace App\Http\Livewire;

use App\Models\booking_details;
use App\Models\services;
use Livewire\Component;

class HomeShow extends Component
{
    public $from = null;
    public $to = null;
    public $hotels = [];
    public $cottages = [];
    public $selected = [];
    public $type = 1;
    public function mount(){
        $this->from = date('Y-m-d');
        $this->to = date('Y-m-d');
        $this->hotels = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',2)->get();
        $this->cottages = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',4)->get();
    }
    public function render()
    {
       
        $this->hotels = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',2)->get();
        $this->cottages = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',4)->get();
        
        return view('livewire.home-show');
    }
    public function change($type){
        $this->type = $type;
    }
}
