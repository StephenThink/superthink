<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class HolidayOverview extends Component
{
    use WithPagination;

    public $modalConfirmDeleteVisible;
    public $modelId;

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return User::paginate(10);
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {

        app('App\Http\Livewire\Holidays')->addingDaysBack();
        Holiday::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Shows the delete confirmation modal.
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }


    public function render()
    {
        // Get all users
        $users = User::all();

        // Get Current Year
        $currentYear = Carbon::now()->year;

        // Get all the holidays for this year and order them by the start date
        $holidays = Holiday::whereYear('start', $currentYear)->orderBy('start')->get();

        // Create Blank Array
        $allHolidays = [];

        foreach ($users as $user) {
                // See if a user has a holiday and if they do add them to their array
                $allHolidays[$user->name] = $holidays->where('user_id', '=', $user->id);
        }



        return view('livewire.holiday-overview', [
            'staff' => $this->read(),
            'data' => $allHolidays,
        ]);
    }
}
