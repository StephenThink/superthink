<?php

namespace App\Providers;

use App\Models\Holiday;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('exclude_pre_leaves', function ($attribute, $value, $p, $validator) {
            $data = $validator->getData();
            $start = $data[$p[0]];
            $end = $data[$p[1]];
            $hasMatched = Holiday::where('user_id', $data['user_id'])
                ->where(function ($query) use ($start, $end) {
                    $query->where(function ($q) use ($start, $end) {
                        $q->where('start', '>=', $start)
                        ->where('start', '<', $end);
                    })->orWhere(function ($q) use ($start, $end) {
                        $q->where('start', '<=', $start)
                        ->where('start', '>', $end);
                    })->orWhere(function ($q) use ($start, $end) {
                        $q->where('end', '>', $start)
                        ->where('end', '<=', $end);
                    })->orWhere(function ($q) use ($start, $end) {
                        $q->where('start', '>=', $start)
                        ->where('end', '<=', $end);
                    });
                })->count();
            return $hasMatched === 0 ? true : false;
        }, 'This date already falls within a holiday already booked.');

    }
}
