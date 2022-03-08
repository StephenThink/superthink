<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Holiday;
use Livewire\Component;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCalendar\LivewireCalendar;

class AllHolidaysCalendar extends LivewireCalendar
{
    public function events(): Collection
    {
        return Holiday::where('authorised', 1)
                ->get()
                ->map(function ($hol) {
                    return [
                        'id' => $hol->id,
                        'title' => $hol->users->name,
                        'description' => 'Holiday for '.
                        (!$hol->halfDay ? Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)->addDay()): Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)).'.5')
                        . (Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)->addDay()) <= 1 ? ' day' : ' days'),
                        'date' => $hol->start,
                    ];
                });
    }
}
