<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\ClientJob;
use App\Models\ClientItem;
use App\Models\ClientJobStatus;
use Illuminate\Support\Facades\DB;

class ClientItems extends Component
{

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $jobId;

    public $search = '';
    public $orderBy = 'description';
    public $orderAsc = true;

    /**
     * Put your custom public properties here!
     */
    public $job_id;
    public $description;
    public $status_id;


    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'job_id' => 'required',
            'description' => 'required',
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
        $data = ClientItem::find($this->modelId);
        // Assign the variables here
        $this->job_id = $data->job_id;
        $this->description = $data->description;
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
            'job_id' => $this->job_id,
            'description' => $this->description,
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


        ClientItem::create($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', $this->description . ' has been successfully created.');
        $this->emit('updateJobs');
    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return ClientItem::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')->get();
    }


    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {

        $this->validate();
        ClientItem::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        session()->flash('message', $this->description . 's record has been successfully updated.');
        $this->emit('updateJobs');
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        ClientItem::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
        session()->flash('trash', 'Item has been successfully deleted.');
    }

    /**
     * Shows the create modal
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->job_id = '';
        $this->description = '';
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
        $js = ClientItem::findOrFail($jsId);
        // If status is 3 for Completed or 4 for Archived then
        if ($js->status_id >= 3) {
            $js->status_id = 1;
            $js->update(['status_id', $js->status_id]);
        } else {
            $js->increment('status_id', 1);
        }
        $this->emit('updateJobs');
    }

    public function archiveJob($id)
    {
        $js = ClientItem::findOrFail($id);
        $js->status_id = 4;
        $js->save();
        session()->flash('message', 'Job Archived');
        $this->emit('updateJobs');
    }

    public function render()
    {

        $jobList = ClientJob::where('status_id', '<>', '4')->get();
        return view('livewire.clients.client-items', [
            'data' => $this->read(),
            'jobs' => $jobList,
            'jobStatus' => ClientJobStatus::all(),
        ]);
    }
}
