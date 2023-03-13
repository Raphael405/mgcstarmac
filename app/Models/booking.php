<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'total',
        'date',
        'status',
        'reason',

    ];
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
    public function booking_details(){
        return $this->hasMany(booking_details::class,'bookings_id');
    }
    public function payments(){
        return $this->hasMany(booking_payments::class,'bookings_id');
    }

    public function room_quan(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',2)->pluck('id'))->count();
    }
    public function room_total(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',2)->pluck('id'))->sum('subtotal');
    }
    public function cottages_quan(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',4)->pluck('id'))->count();
    }
    public function cottages_total(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',4)->pluck('id'))->sum('subtotal');
    }
    public function activities_quan(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',1)->pluck('id'))->count();
    }
    public function activities_total(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',1)->pluck('id'))->sum('subtotal');
    }
    public function food_quan(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',6)->pluck('id'))->count();
    }
    public function food_total(){
        return booking_details::where('bookings_id',$this->id)->whereIn('services_id',services::where('services_types_id',6)->pluck('id'))->sum('subtotal');
    }
}
