<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from',
        'message',
        'read',
        'subject',
        'requestedId',
        ];

        public function users()
        {
            return $this->belongsTo('App\Models\User', 'user_id');
        }

        public function sender()
        {
            return $this->belongsTo('App\Models\User', 'from');
        }
}

