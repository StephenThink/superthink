<?php

namespace App\Http\Livewire\calendars;

use App\Models\BankHoliday;
use Carbon\Carbon;
use App\Models\Holiday;
use Livewire\Component;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCalendar\LivewireCalendar;


class HolidayCalendar extends LivewireCalendar
{
    public function events(): Collection
    {
        return Holiday::where('user_id', auth()->user()->id)
            ->where('authorised', 1)
            ->get()
            ->map(function ($hol) {
                return [
                    'id' => $hol->id,
                    'title' => ($hol->bankholiday ? BankHoliday::where('bankdate', $hol->start)->pluck('description')->first() : $hol->users->name),
                    'description' => ($hol->bankholiday ? '' :
                        'Holiday for ' .
                        (!$hol->halfDay ? Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)->addDay()) : Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)) . '.5')
                        . (Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)->addDay()) <= 1 ? ' day' : ' days')),
                    'date' => $hol->start,
                ];
            });
    }

    public function onEventClick($eventId)
    {
    }
}
