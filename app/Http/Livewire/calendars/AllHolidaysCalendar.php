<?php

namespace App\Http\Livewire\calendars;

use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Message;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\WorkingDay;
use App\Models\BankHoliday;
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
                    'title' => ($hol->bankholiday ? BankHoliday::where('bankdate', $hol->start)->pluck('description')->first() : $hol->users->name),
                    'description' => ($hol->bankholiday ? $hol->users->name :
                        'Holiday for ' .
                        (!$hol->halfDay ? Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)->addDay()) : Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)) . '.5')
                        . (Carbon::parse($hol->start)->diffInDays(Carbon::parse($hol->end)->addDay()) <= 1 ? ' day' : ' days')),
                    'date' => $hol->start,
                ];
            });
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        $grabUserID = Holiday::find($eventId)->user_id;

        // Get Original Date
        $oriStart = Carbon::parse(Holiday::find($eventId)->start);
        $oriEnd = Carbon::parse(Holiday::find($eventId)->end);

        $grabDaysTaken = $oriStart->diffInDays($oriEnd) + 1;

        // New Start
        $newStart = $year . '-' . $month . '-' . $day;
        $formattedNewStart = Carbon::parse($newStart)->toFormattedDateString();

        // Working out the new end from the days taken.
        $newEnd = Carbon::parse($formattedNewStart)->addDays($grabDaysTaken);



        // calculate True Days

        $workDays = WorkingDay::where('user_id', $grabUserID)
            ->select('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday')
            ->first()
            ->toArray();

        $total = 0;

        // This creates a Carbon Period (Array) of days requested
        $period = CarbonPeriod::create($newStart, $newEnd);

        // Foreach Day, it converts the value to a day and compares it against where they work or not.
        foreach ($period as $key => $value) {
            $index = strtolower(Carbon::parse($value)->format('l'));
            if ($workDays[$index] == 1)
                $total++;

        }
dd($total);

        // Want to see how many days are different between ori start and new start
        $movedDatesAmount = $oriStart->diffAsCarbonInterval(Carbon::parse($newStart), false);

        // Works out wether its subtracting or adding the days
        if ($movedDatesAmount->invert) {
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
