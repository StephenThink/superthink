<?php

namespace App\Http\Livewire\Reset;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;

class Holidays extends Component
{
    public $baseHolidays = 20;
    public $modelId;

    /**
     * Put your custom public properties here!
     */
    public $name;
    public $dateStarted;
    public $leaveDays;
    public $resetDaysValue;

    public function calculateEntitlement()
    {
        $users = User::select('id', 'name', 'dateStarted')->get();
        foreach ($users as $key => $user) {

            $dE = Carbon::parse($user->dateStarted)->diffInYears();

            // This sets out to add extra days to the base holiday value
            // However you cannot have anymore than 25 days.
            switch ($dE) {
                case 1:
                    $daysToTake = $this->baseHolidays;
                    break;

                case 2:
                    $daysToTake = $this->baseHolidays;
                    break;

                case 3:
                    $daysToTake = $this->baseHolidays + 1;
                    break;

                case 4:
                    $daysToTake = $this->baseHolidays + 2;
                    break;

                case 5:
                    $daysToTake = $this->baseHolidays + 3;
                    break;

                case 6:
                    $daysToTake = $this->baseHolidays + 4;
                    break;

                case 7:
                    $daysToTake = $this->baseHolidays + 5;
                    break;

                default:
                    $daysToTake = 25;
            }


            $user->entitlement = $daysToTake;
        }
        return $users;
    }

    public function read()
    {
        return $this->calculateEntitlement();
    }

    public function updateHolidays($id, $resetDaysValue)
    {
        User::find($id)->update(['leaveDays' => $resetDaysValue]);
    }

    public function render()
    {


        return view('livewire.reset.holidays', [
            'data' => $this->read(),
        ]);
    }
}
