<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class Frontpage extends Component
{

    public $title;
    public $content;

    /**
     * The Livewire mount function.
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function mount($urlslug)
    {
        $this->retrieveContent($urlslug);
    }

    /**
     * Gets the Page data from the database
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function retrieveContent($urlslug)
    {
        $data = Page::where('slug', $urlslug)->first();
        $this->title = $data->title;
        $this->content = $data->content;
    }



    public function render()
    {
        return view('livewire.frontpage')->layout('layouts.frontpage');
    }
}
