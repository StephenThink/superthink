<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'bankdate'
    ];

    protected $casts = [
        'bankdate' => 'datetime',
    ];


    public function getBankDateAttribute($value)
    {
        return Carbon::parse($value)->format('l jS F Y');
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
            : static::query()->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    }
}
