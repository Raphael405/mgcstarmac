<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_type',
    ];

    public function services(){
        return $this->hasMany(services::class,'service_types_id');
    }
}
