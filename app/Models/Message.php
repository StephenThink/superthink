<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    /**
     * Makes the Search function work in the blade files
     *
     * @param  mixed $search
     * @return void
     */
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('created_at', 'like', '%' . $search . '%')
            ->orWhere('from', 'like', '%' . $search . '%')
            ->orWhere('subject', 'like', '%' . $search . '%')
            ->orWhere('message', 'like', '%' . $search . '%');
    }
}
