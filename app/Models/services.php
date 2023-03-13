<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;

    protected $fillable = [
        'services_types_id',
        'name',
        'description',
        'price',
        'location',

    ];
    public function type()
    {
        return $this->belongsTo(services_type::class,'services_types_id');
    }
    public function images(){
        return $this->hasMany(services_images::class,'services_id');
    }
}
