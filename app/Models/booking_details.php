<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'bookings_id',
        'services_id',
        'quantity',
        'subtotal',
        'date',
        'status',
    ];
    public function booking()
    {
        return $this->belongsTo(booking::class,'bookings_id');
    }
    public function service()
    {
        return $this->belongsTo(services::class,'services_id');
    }
}
