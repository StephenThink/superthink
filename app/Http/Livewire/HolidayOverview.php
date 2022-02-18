<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class HolidayOverview extends Component
{
    use WithPagination;



    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return User::paginate(10);
    }



    public function render()
    {

        $users = User::all(); // Get all users
        $usersIds = $users->pluck('id'); // Get users id's
        $holidays = Holiday::orderBy('start')->get();

        $allHolidays = [];
        $allHolidays = $usersIds;

        foreach ($users as $key => $user) {

                $allHolidays[$user->name] = $holidays->where('user_id', '=', $user->id);

        }


        foreach ($users as $key => $user ){

            unset($allHolidays[$key]);
        }


// dd($allHolidays);

        return view('livewire.holiday-overview', [
            'staff' => $this->read(),
            'data' => $allHolidays,
        ]);
    }
}
