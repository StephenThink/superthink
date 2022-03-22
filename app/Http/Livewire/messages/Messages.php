<?php

namespace App\Http\Livewire\messages;

use App\Models\User;
use App\Models\Holiday;
use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;
    public $modelId;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = true;

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

    public function readMessage($id)
    {
        Message::find($id)->update(['read' => 1]);
    }


    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return Message::search($this->search)
            ->whereUserId(auth()->user()->id)
            ->whereRead(0)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.messages.messages', [
            'data' => $this->read(),
        ]);
    }
}
