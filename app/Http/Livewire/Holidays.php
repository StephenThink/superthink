<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Holiday;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\WorkingDay;
use App\Http\Livewire\Users;
use Livewire\WithPagination;

class Holidays extends Component
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
     * This takes the Days that should of been taken and adds them back to the user field
     *
     * @return void
     */
    public function addingDaysBack() {

        $event = Holiday::findOrFail($this->modelId);
        // Remove Days Leave
        User::findOrFail($event->user_id)->increment('leaveDays', $event->daysTaken);
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

        // The User who has logged in
        $this->authorisedBy = Auth()->user()->id;

        // If they have enough days let them book the holiday.
        if ($this->leaveDays > $this->daysTaken) {
            Holiday::create($this->modelData());

            // Remove Days Leave
            User::findOrFail($this->user_id)->decrement('leaveDays', $this->daysTaken);

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
        return Holiday::where('start', '>=', now())
        ->orWhere('end','>',now())
        ->orderBy('start', 'asc')
        ->paginate(10);
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
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {

        $this->addingDaysBack();
        Holiday::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
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
        $staffNames = User::all();

        return view('livewire.holidays', [
            'data' => $this->read(),
            'staffMembers' => $staffNames
        ]);
    }
}
