<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Allows Mass Assignment
    protected $guarded = [];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('title', 'like', '%'.$search.'%')
                ->orWhere('link', 'like', '%'.$search.'%')
                ->orWhere('content', 'like', '%'.$search.'%');
    }
}
