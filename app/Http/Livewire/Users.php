<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
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

    /**
     * Put your custom public properties here!
     */
    public $role;
    public $name;
    public $email;
    public $password;
    public $passwordConfirmation;

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
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation',
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
        $data = User::find($this->modelId);
        $this->role = $data->role;
        $this->name = $data->name;
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
            'role' => $this->role,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
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
        User::create($this->createModelData());
        // Find out New Users ID
        $this->newUserId = User::where('email', $this->email)->first();

        // Get the new Team ID
        $newTeamId = DB::table('teams')->get()->count() + 1;

        // Create Team for User
        DB::table('teams')->insert([
            'user_id' => $this->newUserId->id,
            'name' => explode(' ', $this->newUserId->name, 2)[0]  . "'s Team",
            'personal_team' => 1,
        ]);

        $this->modalCreateFormVisible = false;
        $this->reset();
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
        User::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        User::destroy($this->modelId);
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
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {

        return view('livewire.users', [
            'data' => $this->read(),
        ]);
    }
}
