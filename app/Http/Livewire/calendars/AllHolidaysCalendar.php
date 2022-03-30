<?php

namespace App\Http\Livewire\calendars;

use Carbon\Carbon;
use App\Models\User;
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

        // Grab Event Id
        $hol = Holiday::find($eventId);

        // Grab Information about original Event
        $oriStart = Carbon::parse($hol->start);
        $oriEnd = Carbon::parse($hol->end);


        // Work out the new Drop Date
        $newStart = Carbon::parse($year . '-' . $month . '-' . $day);

        // Work out if the new Date is less days or more days than the original holiday
        $movedDatesAmount = $oriStart->diffAsCarbonInterval($newStart, false);
        if ($movedDatesAmount->invert) {
            $newEnd = $oriEnd->subDays($movedDatesAmount->d);
        } else {
            $newEnd = $oriEnd->addDays($movedDatesAmount->d);
        }


        // calculate True Days

        $workDays = WorkingDay::where('user_id', $hol->user_id)
            ->select('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday')
            ->first()
            ->toArray();
        $total = 0;

        // This creates a Carbon Period (Array) of days requested
        $period = CarbonPeriod::create($newStart, $newEnd);


        // Foreach Day, it converts the value to a day and compares it against where they work or not.
        foreach ($period as $key => $value) {
            $index = strtolower(Carbon::parse($value)->format('l'));
            if ($workDays[$index] == 1) {

                $total++;
            }
        }



        // If you they take half a day then subtract it from the total.
        if ($hol->halfDay) {
            $newDaysTaken = $total - .5;
        } else {
            $newDaysTaken = $total;
        }



        // Add or Sub from Leave Days
        $userDetails = User::find($hol->user_id);

        if ($hol->daysTaken < $newDaysTaken) {
            $amount = $newDaysTaken - $hol->daysTaken;
            $userDetails->decrement('leaveDays', $amount);
        } elseif ($hol->daysTaken > $newDaysTaken) {
            $amount =  $hol->daysTaken - $newDaysTaken;
            $userDetails->increment('leaveDays', $amount);
        } else {
            // Do Nothing
        }

        // Update Database

        Holiday::find($eventId)
            ->update([
                'start' => $newStart,
                'end' => $newEnd,
                'daysTaken' => $newDaysTaken,
            ]);

        Message::create([
            'user_id' => $hol->user_id,
            'from' => auth()->user()->id,
            'subject' => 'Holiday Changed',
            'message' => 'Your new Start date for your holiday is ' . $newStart->toFormattedDateString(),
            'requestedId' => 0,
            'read' => 0,
        ]);

        return redirect(request()->header('Referer'));
    }
}
