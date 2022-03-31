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
   @include('partials.admin.address.table')

    {{-- Modal Form --}}
    @include('partials.admin.address.modal')

    {{-- The Delete Modal --}}
    @include('partials.admin.address.delete')
</div>
