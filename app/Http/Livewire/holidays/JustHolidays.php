<?php

namespace App\Http\Livewire\holidays;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

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
        if(Gate::denies('is-holiday-manager'))
        {
            return <<<'blade'

            @include('partials.blades.denies')

        blade;
        }



        return view('livewire.holidays.just-holidays', [
            'staff' => $this->read(),
        ]);
    }
}
