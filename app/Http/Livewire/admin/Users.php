<?php

namespace App\Http\Livewire\admin;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use App\Models\WorkingDay;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalCreateFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'name';
    public $orderAsc = true;

    /**
     * Put your custom public properties here!
     */
    public $name;
    public $email;
    public $password;
    public $passwordConfirmation;
    public $dateStarted;

    public $monday;
    public $tuesday;
    public $wednesday;
    public $thursday;
    public $friday;
    public $saturday;
    public $sunday;

    public $nameOfDeletedUser;

    public $selectedRole = [];

       /**
     * Needed for creating a Teams with a new user
     */
    public $newUserId;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
            'dateStarted' => 'required|date|date_format:Y-m-d',
        ];
    }

    /**
     * This resets the pagination to the first page,
     * just incase the user is on a different page number
     * and the results dont include that amount of
     * results to cover the pagination.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Loads the model data
     * of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = User::find($this->modelId);
        $this->name = $data->name;
        $this->email = $data->email;
        // Have to put this Carbon instance in otherwise the date input on the form will not populate.
        $this->dateStarted = Carbon::parse($data->dateStarted)->toDateString();
        $this->selectedRole = DB::table('role_user')
        ->where('user_id', $this->modelId)
        ->pluck('role_id');
        $convertArray = [];
        // Allows livewire to populate the update form with any data that exists.
        foreach ($this->selectedRole as $key => $value) {
            $convertArray[$value] = "true";
        }
        $this->selectedRole = $convertArray;
    }

    /**
     * The data for the model mapped
     * in this component. This is used for
     * create/update to the database
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'dateStarted' => $this->dateStarted,
            'selectedRole' => $this->selectedRole,
        ];
    }

    /**
     * The data for the model mapped
     * in this component.
     *
     * @return void
     */
    public function createModelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'dateStarted' => $this->dateStarted,
            'selectedRole' => $this->selectedRole,
        ];
    }

    /**
     * This is used to populate the working days database,
     * from the User Creation Form
     *
     * @return void
     */
    public function workDayModelData()
    {
        return [
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


        // Converts the Trues into an array of key values that can
        // be used to populate the roles_user table for the
        // many to many relationship
        $breakDownRoles = [];
        foreach ($this->selectedRole as $key => $value) {
            $breakDownRoles[] = $key;
        }

        $user = User::create($this->createModelData());
        // Find out New Users ID


        $user->roles()->sync($breakDownRoles);

        // Get the new Team ID
        $newTeamId = DB::table('teams')->get()->count() + 1;

        // Create Team for User
        DB::table('teams')->insert([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]  . "'s Team",
            'personal_team' => 1,
        ]);

        // Sets the days of the week into false and true,
        // so when they go into the database there are not set as null values
        ($this->monday == true) ? $this->monday = true : $this->monday = false;
        ($this->tuesday == true) ? $this->tuesday = true : $this->tuesday = false;
        ($this->wednesday == true) ? $this->wednesday = true : $this->wednesday = false;
        ($this->thursday == true) ? $this->thursday = true : $this->thursday = false;
        ($this->friday == true) ? $this->friday = true : $this->friday = false;
        ($this->saturday == true) ? $this->saturday = true : $this->saturday = false;
        ($this->sunday == true) ? $this->sunday = true : $this->sunday = false;

        WorkingDay::create([
            'user_id' => $user->id,
            'monday' => $this->monday,
            'tuesday' => $this->tuesday,
            'wednesday' => $this->wednesday,
            'thursday' => $this->thursday,
            'friday' => $this->friday,
            'saturday' => $this->saturday,
            'sunday' => $this->sunday,
        ]);

        $this->modalCreateFormVisible = false;
        session()->flash('message', $user->name . 's record has been successfully created.');
        $this->reset();

    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return User::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $user = User::find($this->modelId);

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'dateStarted' => 'required|date|date_format:Y-m-d',
        ]);

        // dd($this);

        $breakDownRoles = [];
        foreach ($this->selectedRole as $key => $value) {
            if($value == 1 || $value == "true")
            {
                $breakDownRoles[] = $key;
            }

        }

        // dd($breakDownRoles);

        $user->update($this->modelData());

        $user->roles()->sync($breakDownRoles);

        $this->modalFormVisible = false;
        session()->flash('message', $this->name . 's record has been successfully updated.');
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {

        User::destroy($this->modelId);

        // Also Soft Deletes it from the Working Day Table as otherwise there would be an error.
        WorkingDay::destroy($this->modelId);
        // Delete the team as well
        Team::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        session()->flash('trash', $this->nameOfDeletedUser . 's record has been successfully deleted.');
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
        $this->modalCreateFormVisible = true;
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
        $this->nameOfDeletedUser = User::whereId($this->modelId)->pluck('name')->first();
        $this->modalConfirmDeleteVisible = true;
    }

    /**
     * Send the User to the Route Specificed Below
     *
     * @return void
     */
    public function goToTrashedUsers()
    {
        return redirect()->route('users-trashed');
    }

    public function render()
    {
        /* If the user somehow gets to this area
        and they are dont have permission, this will
        hide any data tables and produce a warning message */
        if(Gate::denies('is-user-manager'))
        {
            return <<<'blade'

            @include('partials.blades.denies')

        blade;
        }

        /* If the User is allowed to access the users area */
        return view('livewire.admin.users', [
            'data' => $this->read(),
            'trashedCount' => User::onlyTrashed()->get()->count(),
            'roles' => Role::all(),
        ]);
    }


}
