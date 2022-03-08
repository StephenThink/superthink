<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Message;
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

    public function onEventDropped($eventId, $year, $month, $day)
    {
        // New Start
        $newStart = $year . '-' . $month . '-' . $day;
        $formattedNewStart = Carbon::parse($newStart)->toFormattedDateString();

        // Get Original Date
        $oriStart = Carbon::parse(Holiday::where('id', $eventId)->pluck('start')->first());
        $oriEnd = Carbon::parse(Holiday::where('id', $eventId)->pluck('end')->first());

        // Want to see how many days are different between ori start and new start
        $movedDatesAmount = $oriStart->diffAsCarbonInterval(Carbon::parse($newStart),false);

        // Works out wether its subtracting or adding the days
        if ($movedDatesAmount->invert)
        {
            $newEnd = Carbon::parse($oriEnd)->subDays($movedDatesAmount->d);
        } else {
            $newEnd = Carbon::parse($oriEnd)->addDays($movedDatesAmount->d);
        }

        Holiday::where('id', $eventId)
            ->update([
                'start' => $newStart,
                'end' => $newEnd,
        ]);

        Message::create([
            'user_id' => Holiday::whereId($eventId)->pluck('user_id')->first(),
            'from' => auth()->user()->id,
            'subject' => 'Holiday Changed',
            'message' => 'Your new Start date for your holiday is ' . $formattedNewStart,
            'requestedId' => 0,
            'read' => 0,
        ]);

        return redirect(request()->header('Referer'));
    }
}
