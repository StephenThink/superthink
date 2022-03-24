<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Makes the Search function work in the blade files
     *
     * @param  mixed $search
     * @return void
     */
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('title', 'like', '%'.$search.'%');
    }

    public function passwords()
    {
        return $this->hasMany('App\Models\Vault');
    }

    public function staff()
    {
        return $this->hasMany('App\Models\ClientContact');
    }

    /**
     * When getting the name of the client
     * from the database, it makes the first letter
     * a capital.
     *
     * @param  mixed $value
     * @return void
     */
    public function getNameAttribute($value)
    {
        return Str::title($value);
    }
}
