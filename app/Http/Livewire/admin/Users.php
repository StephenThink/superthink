<?php

namespace App\Http\Livewire\admin;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\WorkingDay;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
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
    public $role;
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

    public function updatedName()
    {
        $this->email = Str::lower($this->name . "@thinkcreative.uk.com");
        if($this->name == "test") {
            $this->password = "password";
            $this->passwordConfirmation = "password";
            $this->dateStarted = "2022-03-16";
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
        $data = User::find($this->modelId);
        $this->role = $data->role;
        $this->name = $data->name;
        $this->dateStarted = $data->dateStarted;
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
            'role' => $this->role,
            'name' => $this->name,
            'dateStarted' => $this->dateStarted,
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
            'role' => 'admin',
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'dateStarted' => $this->dateStarted,
            'selectedRole' => $this->selectedRole,
        ];
    }

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

        $breakDownRoles = [];

        // dd($this->selectedRole);

        foreach ($this->selectedRole as $key => $value) {
            $breakDownRoles[] = $key;
        }

        // dd($breakDownRoles);

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
        // dd($this->dateStarted);
        // Had to turn off validation as it doesnt work with the dateStarted????
        // $this->validate();

        User::find($this->modelId)->update($this->modelData());
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
        // Delete the team as well
        DB::table('teams')->where('user_id', $this->modelId)->delete();
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

    public function goToTrashedUsers()
    {
        return redirect()->route('users-trashed');
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'data' => $this->read(),
            'trashedCount' => User::onlyTrashed()->get()->count(),
            'roles' => Role::all(),
        ]);
    }


}
