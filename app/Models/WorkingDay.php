<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WorkingDay extends Model
{
    use HasFactory;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];

    /**
     * Creates a relationship to the User Table
     *
     * @return void
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    // public function getMondayAttribute($value)
    // {
    //     if($value) {
    //         return "Yes";
    //     } else {
    //         return "No";
    //     }
    // }

    // public function getTuesdayAttribute($value)
    // {
    //     if($value) {
    //         return "Yes";
    //     } else {
    //         return "No";
    //     }
    // }

    // public function getWednesdayAttribute($value)
    // {
    //     if($value) {
    //         return "Yes";
    //     } else {
    //         return "No";
    //     }
    // }

    // public function getThursdayAttribute($value)
    // {
    //     if($value) {
    //         return "Yes";
    //     } else {
    //         return "No";
    //     }
    // }

    // public function getFridayAttribute($value)
    // {
    //     if($value) {
    //         return "Yes";
    //     } else {
    //         return "No";
    //     }
    // }

    // public function getSaturdayAttribute($value)
    // {
    //     if($value) {
    //         return "Yes";
    //     } else {
    //         return "No";
    //     }
    // }

    // public function getSundayAttribute($value)
    // {
    //     if($value) {
    //         return "Yes";
    //     } else {
    //         return "No";
    //     }
    // }
}
