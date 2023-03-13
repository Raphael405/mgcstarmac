<?php

namespace App\Http\Livewire;

use App\Models\booking_details;
use App\Models\services;
use Livewire\Component;

class WalkinShow extends Component
{
    public $from = null;
    public $to = null;
    public $hotels = [];
    public $cottages = [];
    public $selected = [];
    public $type = 1;
    public $activities = [];
    public $entrance = [];
    public $additionals = [];
    public $quantity =1;
    public $foods = [];
    public $food = "";
    public function mount(){
        $this->from = date('Y-m-d');
        $this->to = date('Y-m-d');
        $this->hotels = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',2)->get();
        $this->cottages = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',4)->get();
        $this->activities = services::where('services_types_id',1)->get();
        $this->entrance = services::where('services_types_id',7)->get();
        $this->additionals = services::where('services_types_id',5)->get();
        $this->foods = services::where('services_types_id',6)->get();
    }
    public function render()
    {
        if($this->type == 3 || $this->type == 4 || $this->type == 5){
            $this->to = $this->from;
        }
        $this->foods = services::where('services_types_id',6)->where('location','like','%'.$this->food.'%')->get();
        $this->hotels = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',2)->get();
        $this->cottages = services::whereNotIn('id',booking_details::where('date','>=',$this->from)->where('date','<=',$this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id',4)->get();
        $this->activities = services::where('services_types_id',1)->get();
        return view('livewire.walkin-show');
    }
    public function change($type){
        $this->type = $type;
    }
}
