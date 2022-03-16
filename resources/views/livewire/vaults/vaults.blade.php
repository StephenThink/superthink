<div class="p-6">
    <div class="flex items-center justify-between ">
        <div class="px-4 py-3">
        @include('partials.alerts.alerts')
        </div>

        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
            <x-jet-button wire:click="createShowModal">
                {{ __('Create') }}
            </x-jet-button>
        </div>
   </div>



<div class="search-bar">
    <div class="search-base-settings md:w-3/6 mx-1">
        <input wire:model.debounce.300ms="search" type="text" class="search-input" placeholder="Search Passwords...">
    </div>
    <div class="search-base-settings md:w-1/6 relative mx-1">
        <select wire:model="orderBy" class="search-dropbox" id="grid-state">

            <option value="title">Title</option>
            <option value="login">Login</option>
            <option value="url">URL</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

        </div>
    </div>
    <div class="search-base-settings md:w-1/6 relative mx-1">
        <select wire:model="orderAsc" class="search-dropbox" id="grid-state">
            <option value="1">Ascending</option>
            <option value="0">Descending</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

        </div>
    </div>
    <div class="search-base-settings md:w-1/6 relative mx-1">
        <select wire:model="perPage" class="search-dropbox" id="grid-state">
            <option>10</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

        </div>
    </div>
</div>

    {{-- The data table --}}
    @include('partials.admin.vault.table')



    {{-- Modal Form --}}
    @include('partials.admin.vault.modal')

    {{-- The Delete Modal --}}
    @include('partials.admin.vault.delete')



</div>
