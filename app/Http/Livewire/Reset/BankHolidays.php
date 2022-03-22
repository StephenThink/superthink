<?php

namespace App\Http\Livewire\Reset;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Holiday;
use Livewire\Component;
use App\Models\BankHoliday;
use Livewire\WithPagination;

class BankHolidays extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'bankdate';
    public $orderAsc = true;


    /**
     * Put your custom public properties here!
     */
    public $description;
    public $bankdate;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'description' => 'required',
            'bankdate' => 'required|date|unique:bank_holidays',
        ];
    }

    /**
     * This resets the pagination to the first page,
     * just incase the user is on a different page number
     * and the results dont include that amount of
     * results to cover the pagination.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Loads the model data
     * of this component.
     *
     * @return void
     */
    public function loadModel()
    {
        $data = BankHoliday::find($this->modelId);
        $this->description = $data->description;
        $this->bankdate = Carbon::parse($data->bankdate)->toDateString();
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
            'description' => $this->description,
            'bankdate' => $this->bankdate,
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
        $hol = BankHoliday::create($this->modelData());



        $this->modalFormVisible = false;
        session()->flash('message', $hol->description . ' successfully created.');
        $this->reset();
    }


    public function read()
    {
        return BankHoliday::paginate($this->perPage);
    }

    /**
     * The update function
     *
     * @return void
     */
    public function update()
    {
        $hol = BankHoliday::find($this->modelId);

        $this->validate([
            'description' => 'required',
            'bankdate' => 'required|date|unique:bank_holidays,bankdate,' . $hol->id,
        ]);

        $hol->update($this->modelData());


        $this->modalFormVisible = false;
        session()->flash('message', $this->description . ' has been successfully updated.');
    }



    /**
     * The delete function.
     *
     * @return void
     */
    public function delete()
    {

        BankHoliday::destroy($this->modelId);

        $this->modalConfirmDeleteVisible = false;
        session()->flash('trash', 'The holiday has been successfully deleted.');
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
    public function updateShowModal($id)
    {

        $this->resetValidation();
        $this->reset();
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
    public function deleteShowModal($id)
    {
        $this->modelId = $id;

        $this->modalConfirmDeleteVisible = true;
    }

    public function insertBankHolidays()
    {
        $users = User::pluck('id');
        $banks = BankHoliday::all();

        foreach ($users as $key => $user) {
            foreach ($banks as $k => $bank) {
                Holiday::create([
                    'user_id' => $user,
                    'start' => Carbon::parse($bank->bankdate)->toDateString(),
                    'end' => Carbon::parse($bank->bankdate)->toDateString(),
                    'daysTaken' => 1,
                    'dateAuthorised' => now(),
                    'authorisedBy' => auth()->user()->id,
                    'pending' => '0',
                    'authorised' => '1',
                    'bankholiday' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        session()->flash('message', 'Everyone has now got their Bank Holidays booked.');
    }

    public function removeBankHolidays()
    {

        $hols = Holiday::whereYear('start', Carbon::now()->year)
            ->where('bankholiday', 1)
            ->delete();
        session()->flash('trash', 'Everyone has now got their Bank Holidays removed.');
    }

    public function render()
    {


        $bankHolidaySet = Holiday::whereYear('start', Carbon::now()->year)
            ->where('bankholiday', 1)
            ->get()
            ->count();

        return view('livewire.reset.bank-holidays', [
            'data' => $this->read(),
            'BHS' => $bankHolidaySet,
        ]);
    }
}
