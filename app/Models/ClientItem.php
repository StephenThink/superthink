<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'job_id',
        'description',
        'status_id'
    ];

    public function jobs()
    {
        return $this->belongsTo('App\Models\ClientJob', 'job_id');
    }

    public function statuses()
    {
        return $this->hasOne('App\Models\ClientJobStatus', 'id', 'status_id');
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
            : static::query()->where('description', 'like', '%' . $search . '%');
    }
}
