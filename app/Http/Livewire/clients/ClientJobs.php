<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientJob;
use App\Models\ClientJobStatus;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class ClientJobs extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $clientId;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'job_name';
    public $orderAsc = true;
    /**
     * Put your custom public properties here!
     */
    public $name;
    public $client_id;
    public $job_name;
    public $job_number;
    public $budget;
    public $status_id;


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
            'job_name' => 'required',
            'job_number' => 'required',
            'budget' => 'required',
            'status_id' => 'required',
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
        $data = ClientJob::find($this->modelId);
        // Assign the variables here
        $this->client_id = $data->client_id;
        $this->job_name = $data->job_name;
        $this->job_number = $data->job_number;
        $this->budget = $data->budget;
        $this->status_id = $data->status_id;
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
            'job_name' => $this->job_name,
            'job_number' => $this->job_number,
            'budget' => $this->budget,
            'status_id' => $this->status_id,
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

        ClientJob::create($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', $this->job_name . ' has been successfully created.');
        $this->resetPage();
    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return ClientJob::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->whereClientId($this->clientId)
            ->paginate($this->perPage);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $this->client_id = $this->clientId;
        $this->validate();
        ClientJob::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->resetPage();
        session()->flash('message', $this->job_name . 's record has been successfully updated.');
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        ClientJob::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
        session()->flash('trash', 'Job has been successfully deleted.');
    }

    /**
     * Shows the create modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->job_name = '';
        $this->job_number = '';
        $this->budget = '';
        $this->status_id = '';
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


    public function toggleStatuses($jsId)
    {
        // Find Current Job
        $js = ClientJob::findOrFail($jsId);
        // If status is 3 for Completed or 4 for Archived then
        if ($js->status_id >= 3) {
            $js->status_id = 1;
            $js->update(['status_id', $js->status_id]);
        } else {
            $js->increment('status_id', 1);
        }
        $this->resetPage();
    }

    public function archiveJob($id)
    {
        $js = ClientJob::findOrFail($id);
        $js->status_id = 4;
        $js->save();
        session()->flash('message', 'Job Archived');
        // $this->resetPage();
    }


    public function render()
    {
        return view('livewire.clients.client-jobs', [
            'data' => $this->read(),
            'jobStatus' => ClientJobStatus::all(),
        ]);
    }
}
