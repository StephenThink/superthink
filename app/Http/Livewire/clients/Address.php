<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\ClientAddressTypes;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class Address extends Component
{


    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $clientId;

    /**
     * Put your custom public properties here!
     */
    public $client_id;
    public $type;
    public $property_name;
    public $property_number;
    public $address_1;
    public $address_2;
    public $town_city;
    public $county;
    public $post_code;

    public function mount($id)
    {
        # code...
        $this->clientId = $id;
    }

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'client_id' => 'sometimes',
            'type' => 'required',
            'property_name' => 'sometimes',
            'property_number' => 'sometimes',
            'address_1' => 'sometimes',
            'address_2' => 'sometimes',
            'town_city' => 'sometimes',
            'county' => 'sometimes',
            'post_code' => 'required',
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
        $data = ClientAddress::find($this->modelId);
        // Assign the variables here
        $this->client_id = $data->client_id;
        $this->type = $data->type;
        $this->property_name = $data->property_name;
        $this->property_number = $data->property_number;
        $this->address_1 = $data->address_1;
        $this->address_2 = $data->address_2;
        $this->town_city = $data->town_city;
        $this->county = $data->county;
        $this->post_code = $data->post_code;
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
            'type' => $this->type,
            'property_name' => $this->property_name,
            'property_number' => $this->property_number,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'town_city' => $this->town_city,
            'county' => $this->county,
            'post_code' => $this->post_code,
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
        $this->client_id = $this->clientId;
        ClientAddress::create($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'Address has been successfully created.');
        $this->resetPage();
    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return ClientAddress::whereClientId($this->clientId)->paginate(10);
    }


    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        ClientAddress::findOrFail($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', 'Address has been successfully updated.');
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        ClientAddress::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
        session()->flash('trash', 'Address has been successfully deleted.');
    }

    /**
     * Shows the create modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
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

        return view('livewire.clients.address', [
            'data' => $this->read(),
            'addressTypes' => ClientAddressTypes::all(),
        ]);
    }
}
