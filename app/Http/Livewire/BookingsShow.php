<?php

namespace App\Http\Livewire;

use App\Models\booking;
use App\Models\User;
use Livewire\Component;

class BookingsShow extends Component
{
    public $bookings = [];
    public $status = "";
    public $search = "";
    public $type = "";
    public function mount(){
        $this->bookings = booking::where('status','like','%'.$this->status.'%')->get();
    }
    public function render()
    {
        $this->bookings = booking::where('status','like','%'.$this->status.'%')->whereIn('users_id',User::where('fname','like','%'.$this->search.'%')->orWhere('lname','like','%'.$this->search.'%')->orWhere('mname','like','%'.$this->search.'%')->pluck('id'))->where('reason','like','%'.$this->type.'%')->get();
        return view('livewire.bookings-show');
    }
}
