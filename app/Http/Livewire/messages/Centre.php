<?php

namespace App\Http\Livewire\messages;

use App\Models\User;
use App\Models\Holiday;
use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class Centre extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $sendModalFormVisible;
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
            'user_id' => 'required',
            'subject' => 'required',
            'message' => 'required',
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
        $this->read = 0;
        $this->from = auth()->user()->id;
        Message::create($this->modelData());
        $this->sendModalFormVisible = false;
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
            ->where('user_id', auth()->user()->id)
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
        $this->sendModalFormVisible = true;
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
        Message::whereId($id)->update(['read' => '1']);
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

    public function toggleRead($id)
    {

        $read = Message::whereId($id)->pluck('read')->first();
        if ($read == 0) {
            // Change to 1 to reflect its been read
            Message::whereId($id)->update(['read' => '1']);
        } else {
            // Change to 0 to reflect its been unread
            Message::whereId($id)->update(['read' => '0']);
        }
    }


    public function viewAllMessages()
    {
        $this->read();
    }

    public function viewUnreadMessages()
    {
    }

    public function granted($eventId, $messageId)
    {
        // Need to change the holiday from pending to autorised
        $event = Holiday::find($eventId);
        $event->update([
            'pending' => 0,
            'authorised' => 1,
            'authorisedBy' => auth()->user()->id,

        ]);

        // Send message to User to say its granted
        Message::create([
            'user_id' => $event->user_id,
            'from' => auth()->user()->id,
            'subject' => 'Holiday Granted',
            'message' => $event->daysTaken . " days starting from " . $event->start,
            'requestedId' => $event->id,
            'read' => 0,
        ]);

        // Update Current Message to Read
        Message::find($messageId)->update(['read' => 1]);
    }

    public function denyed($eventId, $messageId)
    {
        // Need to change the holiday from pending to not authorised
        $event = Holiday::find($eventId);

        User::findOrFail($event->user_id)->increment('leaveDays', $event->daysTaken);
        Holiday::destroy($eventId);

        // Send message to User to say its granted
        Message::create([
            'user_id' => $event->user_id,
            'from' => auth()->user()->id,
            'subject' => 'Holiday Denyed',
            'message' => $event->daysTaken . " days not starting from " . $event->start,
            'requestedId' => 0,
            'read' => 0,
        ]);

        // Update Current Message to Read
        Message::find($messageId)->update(['read' => 1]);
    }

    public function render()
    {
        return view('livewire.messages.centre', [
            'data' => $this->read(),
            'users' => User::all(),
            'unreadCount' => Message::where('user_id', auth()->user()->id)->whereRead('0')->get()->count(),
        ]);
    }
}
