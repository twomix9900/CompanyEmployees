<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'email', 'email');
    }
}
