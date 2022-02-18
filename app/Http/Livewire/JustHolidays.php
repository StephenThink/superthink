<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class JustHolidays extends Component
{

 /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return User::paginate(10);
    }

    public function render()
    {
        return view('livewire.just-holidays', [
            'staff' => $this->read(),
        ]);
    }
}
