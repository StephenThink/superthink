<?php

namespace App\Http\Livewire\Trashed;

use App\Models\Message;
use Livewire\Component;

class Messages extends Component
{

    public $modalConfirmDeleteVisible;
    public $modelId;

    public $nameOfDeletedUser;


    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = true;

    public function goToMessagesCentre()
    {
        return redirect()->route('messages-centre');
    }

    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return Message::search($this->search)
            ->onlyTrashed()
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function restore($id)
    {
        $message = Message::onlyTrashed()->findOrFail($id);
        $message->restore();

        session()->flash('message', 'Message has been successfully restored.');
        $this->redirectIfEmpty();
    }

    public function forceDelete()
    {

        $message = Message::onlyTrashed()->whereId($this->modelId)->first();
        $message->forceDelete();



        $this->modalConfirmDeleteVisible = false;

        session()->flash('trash', 'Message has been successfully obliterated.');
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
        $this->nameOfDeletedUser = User::onlyTrashed()->whereId($this->modelId)->pluck('name')->first();
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {
        return view('livewire.trashed.messages', [
            'data' => $this->read(),
        ]);
    }
}
