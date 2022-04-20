<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientJobStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'icon',
    ];

    // public function jobs()
    // {
    //     return $this->belongsToMany('App\Models\ClientJob');
    // }

    public function job()
    {
        return $this->belongsTo('App\Models\ClientJob', 'status_id');
    }
}