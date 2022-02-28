<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vault extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'client_id',
        'password',
        'login',
        'url',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('client_id', 'like', '%'.$search.'%')
                ->orWhere('title', 'like', '%'.$search.'%')
                ->orWhere('login', 'like', '%'.$search.'%')
                ->orWhere('url', 'like', '%'.$search.'%');
    }
}
