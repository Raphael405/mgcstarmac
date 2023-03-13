<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'bookings_id',
        'amount',
        'proof_of_payment',
        'status',

    ];
    public function booking()
    {
        return $this->belongsTo(booking::class,'bookings_id');
    }
}
