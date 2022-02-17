<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Holiday;


class Dashboard extends Component
{


    public function render()
    {
        $holidays = Holiday::where('user_id',auth()->user()->id)->get();
        return view('livewire.dashboard',
        [
            'holidays' => $holidays
    ]);
    }
}
