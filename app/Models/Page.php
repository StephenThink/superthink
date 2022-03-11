<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Allows Mass Assignment
    protected $guarded = [];

    /**
     * Makes the Search function work in the blade files
     *
     * @param  mixed $search
     * @return void
     */
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('title', 'like', '%'.$search.'%')
                ->orWhere('link', 'like', '%'.$search.'%')
                ->orWhere('content', 'like', '%'.$search.'%');
    }
}
