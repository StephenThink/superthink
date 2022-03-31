<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientAddressTypes;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class AddressTypes extends Component
{

    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $clientId;


    /**
     * Put your custom public properties here!
     */
    public $name;


    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'name' => 'required',
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
        $data = ClientAddressTypes::find($this->modelId);
        // Assign the variables here
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
            'name' => $this->name,
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
        ClientAddressTypes::create($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'New type has been successfully created.');
        $this->reset();
    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return ClientAddressTypes::paginate(10);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        ClientAddressTypes::findOrFail($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'Type has been successfully updated.');
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        ClientAddressTypes::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
        session()->flash('trash', 'Type has been successfully deleted.');
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

        if (Gate::denies('is-client-manager')) {
            return <<<'blade'

            @include('partials.blades.denies')

        blade;
        }

        return view('livewire.clients.address-types', [
            'data' => $this->read(),
        ]);
    }
}
