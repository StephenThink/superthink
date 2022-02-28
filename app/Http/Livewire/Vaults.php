<?php

namespace App\Http\Livewire;

use App\Models\Vault;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Vaults extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'client_id';
    public $orderAsc = true;

    /**
     * Put your custom public properties here!
     */
    public $client_id;
    public $title;
    public $password;
    public $login;
    public $url;
    public $description;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'client_id' => 'required',
            'title' => 'required',
            'password' => 'required',
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
        $data = Vault::find($this->modelId);
        // Assign the variables here
        $this->client_id = $data->client_id;
        $this->title = $data->title;
        $this->password = $data->password;
        $this->login = $data->login;
        $this->url = $data->url;
        $this->description = $data->description;
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
            'title' => $this->title,
            'password' => $this->password,
            'login' => $this->login,
            'url' => $this->url,
            'description' => $this->description,
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
        dd($this->password);
        Vault::create($this->modelData());
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
        return Vault::search($this->search)
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
        Vault::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        Vault::destroy($this->modelId);
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
        $clients = Client::all();

        return view('livewire.vaults', [
            'data' => $this->read(),
            'clients' => $clients,
        ]);
    }

}
