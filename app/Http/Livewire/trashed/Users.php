<?php

namespace App\Http\Livewire\trashed;

use App\Models\Team;
use App\Models\User;
use App\Models\WorkingDay;
use Livewire\Component;

class Users extends Component
{
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $nameOfDeletedUser;


    public $perPage = 10;
    public $search = '';
    public $orderBy = 'name';
    public $orderAsc = true;


    public function goToUsers()
    {
        return redirect()->route('users');
    }


    /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return User::search($this->search)
            ->onlyTrashed()
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function redirectIfEmpty()
    {
        $trashedCount = User::onlyTrashed()->get()->count();

        if ($trashedCount == 0)
        {
            $this->goToUsers();
            session()->flash('redirect','You have been redirected back to the Users Table.');

        }
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        $workdayUser = WorkingDay::onlyTrashed()->findOrFail($id);
        $workdayUser->restore();

        $userTeam = Team::onlyTrashed()->findOrFail($id);
        $userTeam->restore();

        session()->flash('message', $user->name . 's record has been successfully restored.');
        $this->redirectIfEmpty();
    }

    public function forceDelete()
    {

        $user = User::onlyTrashed()->whereId($this->modelId)->first();
        $user->forceDelete();

        $workdayUser = WorkingDay::onlyTrashed()->findOrFail($this->modelId);
        $workdayUser->forceDelete();

        $userTeam = Team::onlyTrashed()->findOrFail($this->modelId);
        $userTeam->forceDelete();

        $this->modalConfirmDeleteVisible = false;

        session()->flash('trash', $user->name . 's record has been successfully obliterated.');
        $this->redirectIfEmpty();

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
        return view('livewire.trashed.users', [
            'data' => $this->read(),
        ]);
    }
}
