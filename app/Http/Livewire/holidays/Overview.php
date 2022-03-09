<?php

namespace App\Http\Livewire\holidays;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\User;
use App\Models\Holiday;
use App\Models\Message;
use App\Models\WorkingDay;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Overview extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $daysErrorVisible = false;

    /**
     * Put your custom public properties here!
     */
    public $user_id;
    public $start;
    public $end;
    public $halfDay;
    public $dateAuthorised;
    public $daysTaken;
    public $authorisedBy;
    public $authorised;

    public $leaveDays;

        /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'dateAuthorised' => 'required|date',
            // 'daysTaken' => 'gte:leaveDays'
        ];
    }

         /**
     * Runs everytime the title gets updated
     *
     * @param  mixed $value
     * @return void
     */
    public function calcDaysTaken()
    {

        // calculate True Days

        $workDays = WorkingDay::where('user_id', $this->user_id)
        ->select('monday','tuesday','wednesday','thursday','friday','saturday','sunday')
        ->first()
        ->toArray();

        $total = 0;

        // This creates a Carbon Period (Array) of days requested
        $period = CarbonPeriod::create($this->start, $this->end);

        // Foreach Day, it converts the value to a day and compares it against where they work or not.
        foreach ($period as $key => $value) {
            $index = strtolower(Carbon::parse($value)->format('l'));
            if ($workDays[$index] == 1)
            $total++;
        }

        // If you they take half a day then subtract it from the total.
        if($this->halfDay) {
            $this->daysTaken = $total - .5;
        } else {
            $this->daysTaken = $total;
        }
        return $this->daysTaken;
    }

    /**
     * Calculates wether or not people should have days added or taken away.
     *
     * @return void
     */
    public function updateLeaveDays()
    {
        $oriDays = Holiday::find($this->modelId)->pluck('daysTaken')->first();

        if ($oriDays != $this->daysTaken) {
            if ($oriDays <= $this->daysTaken) {
                // If There have been less days been taken do this
                $dayDifference = $oriDays - $this->daysTaken;

                User::findOrFail($this->user_id)->increment('leaveDays', $dayDifference);

            } else {
            // If There have been more days been taken do this
            $dayDifference = $this->daysTaken - $oriDays;


                User::findOrFail($this->user_id)->decrement('leaveDays', $dayDifference);

            }
        }
    }

    /**
     * Loads the model data
     * of this component.
     *
     * @return void
     */
    public function loadModel()
    {

        $data = Holiday::find($this->modelId);
        // Assign the variables here
        $this->user_id = $data->user_id;
        $this->start = $data->start;
        $this->end = $data->end;
        $this->halfDay = $data->halfDay;
        $this->dateAuthorised = $data->dateAuthorised;
        $this->daysTaken = $data->daysTaken;
        $this->authorisedBy = $data->authorisedBy;
        $this->authorised = $data->authorised;

    }

    /**
     * The data for the model mapped
     * in this component.
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'user_id' => $this->user_id,
            'start' => $this->start,
            'end' => $this->end,
            'halfDay' => $this->halfDay,
            'dateAuthorised' => $this->dateAuthorised,
            'daysTaken' => $this->daysTaken,
            'authorisedBy' => $this->authorisedBy,
            'authorised' => $this->authorised,
        ];
    }


        /**
     * The create function.
     *
     * @return void
     */
    public function create()
    {
        // Find out how many leave days they have left
        $user = User::findOrFail($this->user_id);
        $this->leaveDays = $user->pluck('leaveDays')->first();

        $this->validate();

        $this->calcDaysTaken();

        $this->authorised = 1;
        // The User who has logged in
        $this->authorisedBy = Auth()->user()->id;

        // If they have enough days let them book the holiday.
        if ($this->leaveDays > $this->daysTaken) {
            Holiday::create($this->modelData());

            // Remove Days Leave
            User::findOrFail($this->user_id)->decrement('leaveDays', $this->daysTaken);


            // Send message to User to say its granted

            Message::create([
                'user_id' => $this->user_id,
                'from' => auth()->user()->id,
                'subject' => 'Holiday Granted',
                'message' => $this->daysTaken . " days starting from " . $this->start,
                'requestedId' => 0,
                'read' => 0,
            ]);

            $this->modalFormVisible = false;
            $this->reset();

        } else {
            $this->daysErrorVisible = true;

        }

    }

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
     * The update function
     *
     * @return void
     */
    public function update()
    {


        $this->validate();
        $this->calcDaysTaken();
        $this->updateLeaveDays();
        Holiday::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

         // Send message to User to say its granted
         Message::create([
            'user_id' => $this->user_id,
            'from' => auth()->user()->id,
            'subject' => 'Holiday Updated',
            'message' => $this->daysTaken . " days starting from " . $this->start,
            'requestedId' => 0,
            'read' => 0,
        ]);
    }

        /**
     * Shows the create modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();

        // To default the Date Authorised to today.
        $this->dateAuthorised = Carbon::now()->toDateString();

        $this->daysErrorVisible = false;
        $this->modalFormVisible = true;
    }

    /**
     * Shows the form modal
     * in update mode.
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        $event = Holiday::findOrFail($this->modelId);


        // Remove Days Leave
        User::findOrFail($event->user_id)->increment('leaveDays', $event->daysTaken);

        Holiday::destroy($this->modelId);

         // Send message to User to say its granted
         Message::create([
            'user_id' => $event->user_id,
            'from' => auth()->user()->id,
            'subject' => 'Holiday Removed',
            'message' => $event->daysTaken . " days starting from " . $event->start,
            'requestedId' => 0,
            'read' => 0,
        ]);
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

    public function granted($eventId)
    {


        // Need to change the holiday from pending to autorised
        $event = Holiday::find($eventId);
        $event->update([
            'pending' => 0,
            'authorised' => 1,
        ]);

        // Send message to User to say its granted
        $message = Message::create([
            'user_id' => $event->user_id,
            'from' => auth()->user()->id,
            'subject' => 'Holiday Granted',
            'message' => $event->daysTaken . " days starting from " . $event->start,
            'requestedId' => $event->id,
            'read' => 0,
        ]);

        // Remove Message from the Holiday Managers
        $unreadMessage = Message::where('requestedId', $eventId)->first();
        $unreadMessage->update([
            'read' => 1,
        ]);
    }

    public function denyed($eventId)
{
    // Need to change the holiday from pending to not authorised
    $event = Holiday::find($eventId);

    User::findOrFail($event->user_id)->increment('leaveDays', $event->daysTaken);
    Holiday::destroy($eventId);

    // Send message to User to say its granted
    Message::create([
        'user_id' => $event->user_id,
        'from' => auth()->user()->id,
        'subject' => 'Holiday Denyed',
        'message' => $event->daysTaken . " days not starting from " . $event->start,
        'requestedId' => 0,
        'read' => 0,
    ]);

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



        return view('livewire.holidays.overview', [
            'staff' => $this->read(),
            'data' => $allHolidays,
            'staffMembers' => User::all(),
        ]);
    }
}
