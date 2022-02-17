<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'start',
    'end',
    'halfDay',
    'daysTaken',
    'dateAuthorised',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
