<?php

namespace App\Http\Livewire\messages;

use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class Centre extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = false;
    /**
     * Put your custom public properties here!
     */
    public $user_id;
    public $read;
    public $message;
    public $from;
    public $subject;

    public $msg;
    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
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
        $data = Message::find($this->modelId);
        // Assign the variables here
        $this->user_id = $data->user_id;
        $this->read = $data->read;
        $this->message = $data->message;
        $this->from = $data->from;
        $this->subject = $data->subject;

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
            'user_id' => $this->user_id,
            'read' => $this->read,
            'message' => $this->message,
            'from' => $this->from,
            'subject' => $this->subject,
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
        Message::create($this->modelData());
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
        return Message::search($this->search)
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
        Message::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {
        $forTrash = Message::where('user_id', auth()->user()->id)
                ->whereRead('1')
                ->delete();
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * The delete function.
     *
     * @return void
     */
    public function trash()
    {
        Message::destroy($this->modelId);
        $this->modalFormVisible = false;
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
    public function modalFormVisible($id)
    {
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
    public function deleteShowModal()
    {
        $this->modalConfirmDeleteVisible = true;
    }



    public function viewAllMessages()
    {
        $this->read();
    }

    public function viewUnreadMessages()
    {

    }

    public function render()
    {
        return view('livewire.messages.centre', [
            'data' => $this->read(),
        ]);
    }
}
