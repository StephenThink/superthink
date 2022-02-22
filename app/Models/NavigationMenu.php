<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'slug',
        'sequence',
        'type'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('type', 'like', '%'.$search.'%')
                ->orWhere('label', 'like', '%'.$search.'%');
    }
}
