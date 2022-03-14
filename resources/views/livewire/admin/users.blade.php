<div class="p-6">
    <div class="flex items-center justify-between ">
        <div class="px-4 py-3">
        @include('partials.alerts.alerts')
        </div>

        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
            <x-jet-button wire:click="createShowModal">
                {{__('Create')}}
            </x-jet-button>
            @if ($trashedCount > 0)
            <x-jet-button class="ml-2" wire:click="goToTrashedUsers()">
                {{__('Trash')}}
            </x-jet-button>
            @endif

        </div>
   </div>

    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text"
                class="search-input"
                placeholder="Search Users...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model.lazy="orderBy"
                class="search-dropbox"
                id="grid-state">
                <option value="name">Name</option>
                <option value="role">Role</option>
                <option value="email">Email</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model.lazy="orderAsc"
                class="search-dropbox"
                id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model.lazy="perPage"
                class="search-dropbox"
                id="grid-state">
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
    @include('partials.user.table')

    {{-- Create Modal Form --}}
    @include('partials.user.create')

    {{-- Update Modal Form --}}
    @include('partials.user.update')

    {{-- The Delete Modal --}}
    @include('partials.user.delete')
</div>
