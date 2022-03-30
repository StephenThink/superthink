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
use Illuminate\Support\Facades\Validator;

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

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            // 'user_id' => 'required',
            'start' => 'exclude_pre_leaves:start,end',
            'end' => 'exclude_pre_leaves:start,end|after_or_equal:start',
            //'dateAuthorised' => 'required|date',
            // 'daysTaken' => 'gte:leaveDays'
        ];
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {

        // Grab Event Id
        $hol = Holiday::find($eventId);
        $userDetails = User::find($hol->user_id);


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

        // Validate to Check to see if the holiday can be moved
        // $validatedData = Validator::make(
        //     [
        //         'user_id' => $userDetails->id,
        //         'start' => $newStart,
        //         'end' => $newEnd,
        //     ],
        //     [
        //         // 'user_id' => 'sometimes',
        //         'start' => 'exclude_pre_leaves:start,end',
        //         'end' => 'exclude_pre_leaves:start,end',
        //     ],
        //     [
        //         'exclude_pre_leaves' => 'This conflicts with another holiday',
        //     ],
        // )->validate();

        // // dd($validatedData);

        // if ($validatedData) {
        //     dd("Yes");
        // } else {
        //     dd("No");
        // }



        // Add or Sub from Leave Days

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
            ->update($this->modelData($newStart, $newEnd, $newDaysTaken));

        $this->createMessage($hol->user_id, auth()->user()->id, $newStart);

        return redirect(request()->header('Referer'));
    }

    public function modelData($start, $end, $daysTaken)
    {
        return [
            'start' => $start,
            'end' => $end,
            'daysTaken' => $daysTaken,
        ];
    }

    public function createMessage($user, $from, $start)
    {
        Message::create([
            'user_id' => $user,
            'from' => $from,
            'subject' => 'Holiday Changed',
            'message' => 'Your new Start date for your holiday is ' . $start->toFormattedDateString(),
            'requestedId' => 0,
            'read' => 0,
        ]);
    }
}
