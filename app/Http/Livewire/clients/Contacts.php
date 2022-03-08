<?php

namespace App\Http\Livewire\clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ClientContact;

class Contacts extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;


    /**
     * Put your custom public properties here!
     */
    public $client_id;
    public $staff_name;
    public $staff_position;
    public $staff_number;
    public $staff_email;
    public $staff_notes;


    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'staff_name' => 'required',
            'staff_position' => 'required',
            'staff_number' => 'required',
            'staff_email' => 'email',

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
        $data = ClientContact::find($this->modelId);
        // Assign the variables here
        $this->client_id = $data->client_id;
        $this->staff_name = $data->staff_name;
        $this->staff_position = $data->staff_position;
        $this->staff_number = $data->staff_number;
        $this->staff_email = $data->staff_email;
        $this->staff_notes = $data->staff_notes;
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
            'client_id' => $this->client_id,
            'staff_name' => $this->staff_name,
            'staff_position' => $this->staff_position,
            'staff_number' => $this->staff_number,
            'staff_email' => $this->staff_email,
            'staff_notes' => $this->staff_notes
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
        ClientContact::create($this->modelData());
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
        return ClientContact::paginate(5);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        ClientContact::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        ClientContact::destroy($this->modelId);
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

    public function render()
    {
        return view('livewire.clients.contacts', [
            'data' => $this->read(),
            'clients' => Client::all()
        ]);
    }
}
