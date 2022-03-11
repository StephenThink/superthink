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

    /**
     * Creates a relationship to the Clients Table
     *
     * @return void
     */
    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
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
            : static::query()
                ->Where('title', 'like', '%'.$search.'%')
                ->orWhere('login', 'like', '%'.$search.'%')
                ->orWhere('url', 'like', '%'.$search.'%');
    }


     /**
      * Decrypts passwords so that they can be
      * seen on the blade file.
      *
      * @param  mixed $value
      * @return void
      */
     public function getPasswordAttribute($value)
    {
        if(!empty($value))
            return decrypt($value);

        return '';

    }
}
