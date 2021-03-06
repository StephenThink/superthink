<?php

namespace App\Http\Livewire\staff;

use App\Models\User;
use App\Models\WorkingDay;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;


class WorkingDays extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    /**
     * Put your custom public properties here!
     */
    public $user_id;
    public $monday;
    public $tuesday;
    public $wednesday;
    public $thursday;
    public $friday;
    public $saturday;
    public $sunday;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'user_id' => "required",
        ];
    }

    /**
     * Loads the model data
     * of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = WorkingDay::find($this->modelId);
        // Assign the variables here
        $this->user_id = $data->user_id;
        $this->monday = $data->monday;
        $this->tuesday = $data->tuesday;
        $this->wednesday = $data->wednesday;
        $this->thursday = $data->thursday;
        $this->friday = $data->friday;
        $this->saturday = $data->saturday;
        $this->sunday = $data->sunday;

    }

    /**
     * The data for the model mapped
     * in this component.
     *
     * @return void
     */
    public function modelData()
    {
        ($this->monday == true) ? $this->monday = true : $this->monday = false;
        ($this->tuesday == true) ? $this->tuesday = true : $this->tuesday = false;
        ($this->wednesday == true) ? $this->wednesday = true : $this->wednesday = false;
        ($this->thursday == true) ? $this->thursday = true : $this->thursday = false;
        ($this->friday == true) ? $this->friday = true : $this->friday = false;
        ($this->saturday == true) ? $this->saturday = true : $this->saturday = false;
        ($this->sunday == true) ? $this->sunday = true : $this->sunday = false;


        return [
            'user_id' => $this->user_id,
            'monday' => $this->monday,
            'tuesday' => $this->tuesday,
            'wednesday' => $this->wednesday,
            'thursday' => $this->thursday,
            'friday' => $this->friday,
            'saturday' => $this->saturday,
            'sunday' => $this->sunday,
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
        WorkingDay::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return WorkingDay::paginate(15);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        WorkingDay::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        WorkingDay::destroy($this->modelId);
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


    /**
     * Change a Day Clicked from Yes to No and Vice Versa
     *
     * @param  integer $id
     * @param  string $day
     * @return void
     */
    public function invertDay($id, $day, $value)
    {

        if($value == 1) {
            WorkingDay::findOrFail($id)->decrement($day);
        } else {
            WorkingDay::findOrFail($id)->increment($day);
        }
        $this->resetPage();
    }


    public function render()
    {

        if(Gate::denies('is-staff-editor'))
        {
            return <<<'blade'

            @include('partials.blades.denies')

        blade;
        }


        // Grab all Users
        // $staffMembers = User::all();

        // Find the users not already in the list
        $notAllocated = WorkingDay::pluck('user_id')->all();

        // Only show Staff members that are not allocated
        $staffMembersNotAllocated = User::whereNotIn('id', $notAllocated)->get();

        return view('livewire.staff.working-days', [
            'data' => $this->read(),
            'staffmembers' => $staffMembersNotAllocated,
        ]);
    }
}
