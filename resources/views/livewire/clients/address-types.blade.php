<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Address Types') }}
    </h2>
</x-slot>

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

    {{-- The data table --}}
   @include('partials.settings.addresstypes.table')

    {{-- Modal Form --}}
    @include('partials.settings.addresstypes.modal')

    {{-- The Delete Modal --}}
    @include('partials.settings.addresstypes.delete')
</div>
