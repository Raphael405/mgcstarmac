<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class StaffShow extends Component
{
    public $staffs;
    public $search;
    public $filter = "Verified";
    public function mount()
    {
        $this->staffs = User::where('user_types_id', 2)->where('verified', "Verified")->get();
    }
    public function render()
    {
        return view('livewire.staff-show');
    }
    public function sort()
    {
        $this->staffs = User::where(function ($q) {
            $q->where('lname', 'like', '%' . $this->search . '%')
                ->orWhere('mname', 'like', '%' . $this->search . '%')
                ->orWhere('fname', 'like', '%' . $this->search . '%');
        })->where('user_types_id', 2)->where('verified', $this->filter)->get();
    }
}
