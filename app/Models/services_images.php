<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services_images extends Model
{
    use HasFactory;
    protected $fillable = [
        'services_id',
        'location',
        'description',

    ];
    public function service()
    {
        return $this->belongsTo(services_type::class,'services_id');
    }
}
