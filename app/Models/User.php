<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'username',
        'password',
        'user_types_id',
        'fname',
        'lname',
        'mname',
        'valid_id',
        'contact_number',
        'email',
        'address',
        'verified',
    ];
    public function user_type()
    {
        return $this->belongsTo(user_type::class,'user_types_id');
    }
    public function fullname(){
        return $this->lname .', ' .$this->fname  .' ' .$this->mname;
    }
}
