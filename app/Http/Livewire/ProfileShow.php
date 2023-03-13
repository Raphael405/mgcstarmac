<?php

namespace App\Http\Livewire;

use App\Models\booking;
use App\Models\booking_details;
use App\Models\services;
use App\Models\User;
use Livewire\Component;

class ProfileShow extends Component
{
    public $user;
    public $from = null;
    public $to = null;
    public $hotels = [];
    public $cottages = [];
    public $selected = [];
    public $type = 1;
    public $activities = [];
    public $foods = [];
    public $entrance = [];
    public $additionals = [];
    public $booking = null;
    public $quantity = 1;
    public $checker = null;
    public $balance = 0;
    public $food = "";
    public function mount($id, $checker)
    {
        $this->from = date('Y-m-d');
        $this->to = date('Y-m-d');
        $this->user = User::find($id);
        $this->hotels = services::whereNotIn('id', booking_details::where('date', '>=', $this->from)->where('date', '<=', $this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id', 2)->get();
        $this->cottages = services::whereNotIn('id', booking_details::where('date', '>=', $this->from)->where('date', '<=', $this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id', 4)->get();
        $this->activities = services::where('services_types_id', 1)->get();
        $this->entrance = services::where('services_types_id', 7)->get();
        $this->additionals = services::where('services_types_id', 5)->get();
        $this->foods = services::where('services_types_id',6)->get();
        if ($checker === 'current') {
            $this->booking = booking::where('users_id', $id)->latest()->first();
        } else {
            $this->booking = booking::find($checker);
        }
        $this->checker = $checker;
    }
    public function render()
    {
     
        if ($this->type == 3 || $this->type == 4 || $this->type == 5) {
            $this->to = $this->from;
        }
        if ($this->booking != null) {
            $this->balance = $this->booking->total;
            foreach ($this->booking->payments as $p) {
                if ($p->status === "Confirmed") {
                    $this->balance -= $p->amount;
                }
            }
        }
        $this->foods = services::where('services_types_id',6)->where('location','like','%'.$this->food.'%')->get();
        $this->hotels = services::whereNotIn('id', booking_details::where('date', '>=', $this->from)->where('date', '<=', $this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id', 2)->get();
        $this->cottages = services::whereNotIn('id', booking_details::where('date', '>=', $this->from)->where('date', '<=', $this->to)->where( function ($e){
            $e->where('status','Ongoing')->orWhere('status','Request');
        })->pluck('services_id'))->where('services_types_id', 4)->get();
        $this->activities = services::where('services_types_id', 1)->get();

    
        return view('livewire.profile-show');
    }
    public function change($type)
    {
        $this->type = $type;
    }

    public function book(){ 
        $booking = booking::find($this->booking->id);
        $days = 1;
        $days += (((strtotime($this->to) - strtotime($this->from)) / 60) / 60) / 24;
        $status = $booking->status;
        foreach ($this->selected as $s) {
            if ($s != null) {
                $service = services::find($s);
                $quan = 1;
                if ($service->services_types_id != 2 && $service->services_types_id != 4) {
                    $quan = $this->quantity;
                }
                for ($x = 0; $x < $days; $x++) {
                    booking_details::create([
                        'bookings_id' => $booking->id,
                        'services_id' => $service->id,
                        'quantity' =>  $quan,
                        'price' => $service->price,
                        'subtotal' => $service->price *  $this->quantity,
                        'date' => date('Y-m-d', strtotime($this->from . ' + ' . $x . ' days')),
                        'status' => $status
                    ]);
                    $booking->total = $booking->total + $service->price *  $this->quantity;
                }
            }
        }
        $booking->save();
        return redirect()->route('profile.show', [$booking->users_id, 'current']);
    }
}
