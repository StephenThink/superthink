<?php

namespace App\Http\Livewire;

use App\Models\Holiday;
use Livewire\Component;
use App\Http\Livewire\Users;
use App\Models\User;
use Carbon\Carbon;
use Livewire\WithPagination;

class Holidays extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

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
        // Grab the dates that we need to work out.
        $d = Carbon::parse($this->start)->floatDiffInDays($this->end);

        // If the start and end are the same date, check to see if the person wants half a day or not
        if ($d === 0) {
            if ($this->halfDay) {
                $this->daysTaken = 0.5;
            } else {
                $this->daysTaken = 1;
            }
        // Again checking to see if the person wants half a day on top of their choosen dates 
        } else {
            if( $this->halfDay) {
                $this->daysTaken = $d + 0.5;
            } else {
                $this->daysTaken = $d;
            }
        }

        return $this->daysTaken;
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

        $this->validate();

        $this->calcDaysTaken();

        $this->authorisedBy = Auth()->user()->id;
        Holiday::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    protected function daysTakenAmount()
    {

    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return Holiday::paginate(10);
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
