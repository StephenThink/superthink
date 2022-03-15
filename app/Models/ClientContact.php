<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'client_id',
        'staff_name',
        'staff_position',
        'staff_number',
        'staff_email',
        'staff_notes',
    ];

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
            : static::query()->where('staff_name', 'like', '%'.$search.'%')
                ->orWhere('staff_position', 'like', '%'.$search.'%')
                ->orWhere('staff_email', 'like', '%'.$search.'%')
                ->orWhere('staff_notes', 'like', '%'.$search.'%')
                ->orWhere('staff_number', 'like', '%'.$search.'%');
    }
}
