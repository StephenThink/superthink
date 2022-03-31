<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientJob extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'client_id',
        'job_name',
        'job_number',
        'budget',
        'status'
    ];

    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function statuses()
    {
        return $this->belongsToMany('App\Models\ClientJobStatus', 'job_status', 'id', 'status_id')->withTimestamps();
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
            : static::query()->where('job_name', 'like', '%' . $search . '%')
            ->orWhere('job_number', 'like', '%' . $search . '%')
            ->orWhere('budget', 'like', '%' . $search . '%');
    }
}
