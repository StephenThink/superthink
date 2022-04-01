<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientJobStatus;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;


class ClientJobStatuses extends Component
{

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    /**
     * Put your custom public properties here!
     */
    public $name;
    public $icon;


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
        $data = ClientJobStatus::find($this->modelId);
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
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return ClientJobStatus::limit(3)->get();
    }


    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        ClientJobStatus::findOrFail($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'Status Name has been successfully updated.');
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


    public function render()
    {
        if (Gate::denies('is-super')) {
            return <<<'blade'

            @include('partials.blades.denies')

        blade;
        }

        return view('livewire.clients.client-job-statuses', [
            'data' => $this->read(),
        ]);
    }
}
