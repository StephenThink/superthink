<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function getStaffNameAttribute($value)
    {
        return Str::headline($value);
    }

    public function getStaffPositionAttribute($value)
    {
        return Str::headline($value);
    }

    public function getStaffNumberAttribute($value)
    {
        // If the telephone number is 11 digits put a break after the 5 digit if not then dont

        if (Str::length($value) == 11) {
            return Str::substr($value, 0, 5) . ' ' . Str::substr($value, 5, 11);
        }
        return $value;
    }

    public function getStaffEmailAttribute($value)
    {
        return Str::lower($value);
    }
}
