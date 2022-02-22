<?php

namespace App\Http\Livewire;

use App\Models\Route;
use Livewire\Component;
use Livewire\WithPagination;

class Routes extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    /**
     * Put your custom public properties here!
     */
    public $type;
    public $address;
    public $view;
    public $name;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'address' => 'required',
            'view' => 'required',
            'name' => 'required',
        ];
    }

    public function updatedAddress() {
        $this->name = $this->address;
        $this->view = $this->address;
    }

    /**
     * Loads the model data
     * of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = Route::find($this->modelId);
        // Assign the variables here
        $this->type = $data->type;
        $this->address = $data->address;
        $this->view = $data->view;
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
            'type' => $this->type,
            'address' => $this->address,
            'view' => $this->view,
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
        Route::create($this->modelData());
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
        return Route::paginate(20);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        Route::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        Route::destroy($this->modelId);
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
        return view('livewire.routes', [
            'data' => $this->read(),
        ]);
    }
}
