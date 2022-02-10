<?php

namespace App\Http\Livewire;

use App\Models\Page;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
       return [
           'title' => 'required',
           'slug' => ['required', Rule::unique('pages','slug')->ignore($this->modelId)],
           'content' => 'required',
       ];
    }

    /**
     * This runs when the page loads.
     *
     * @return void
     */
    public function mount()
    {
        // Resets the pagingation after reloading the page.
        $this->resetPage();
    }

    /**
     * Runs everytime the title gets updated
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value)
    {
        $this->generateSlug($value);
    }

    /**
     * Generates a slug based on the title
     *
     * @param  mixed $value
     * @return void
     */
    private function generateSlug($value)
    {
        $process1 = str_replace(' ', '-', $value);
        $process2 = strtolower($process1);
        $this->slug = $process2;
    }

    /**
     * the create function.
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }


    /**
     * Reads the data from the database
     *
     * @return void
     */
    public function read()
    {
        return Page::paginate(5);
    }

    /**
     * the update function.
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }


    /**
     * the delete function.
     *
     * @return void
     */
    public function delete()
    {
       Page::destroy($this->modelId);
       $this->modalConfirmDeleteVisible = false;
       $this->resetPage();
    }

    /**
     * Loads the model data of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
    }

    /**
     * Shows the form modal of the create function.
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }


    /**
     * Shows the form modal in update mode.
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;
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


    /**
     * The data for the model mapped in this component.
     *
     * @param  mixed $var
     * @return void
     */
    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }


    /**
     * Clears all the variables to as they were
     *
     * @return void
     */
    public function resetVars()
    {
        $this->modelId = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }

    /**
     * The livewire render function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }
}
