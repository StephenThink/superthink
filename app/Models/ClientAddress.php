<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'client_id',
        'type',
        'property_name',
        'property_number',
        'address_1',
        'address_2',
        'town_city',
        'county',
        'post_code',
    ];


    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function types()
    {
        return $this->belongsTo('App\Models\ClientAddressTypes', 'type', 'id');
    }
}
