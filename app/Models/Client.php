<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
