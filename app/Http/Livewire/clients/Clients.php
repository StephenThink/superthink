<?php

namespace App\Http\Livewire\clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;


class Clients extends Component
{
    use WithPagination;

    public $modalFormVisible;
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
    public $nameOfDeletedClient;


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
        $data = Client::find($this->modelId);
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
        Client::create($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', $this->name . 's record has been successfully created.');
        $this->reset();

    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return Client::search($this->search)
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
        $this->validate();
        Client::find($this->modelId)->update($this->modelData());
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
        Client::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
        session()->flash('trash', $this->nameOfDeletedClient . 's record has been successfully deleted.');

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
        $this->nameOfDeletedClient = Client::whereId($this->modelId)->pluck('name')->first();
        $this->modalConfirmDeleteVisible = true;
    }

    public function eventShow($id)
    {

        return redirect()->route('client-profile', $id);
    }

    public function render()
    {
        if(Gate::denies('is-client-manager'))
        {
            return <<<'blade'

            @include('partials.blades.denies')

        blade;
        }

        return view('livewire.clients.clients', [
            'data' => $this->read(),
        ]);
    }
}
