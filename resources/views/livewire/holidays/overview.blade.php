<div class="p-6">
    <div class="flex items-center justify-between mx-2">
        <div class="flex">
            <div class="text-2xl p-2">
                Holiday by Staff Members
            </div>
            <div class="px-4 py-3">
                @include('partials.alerts.alerts')
            </div>
        </div>
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    @include('partials.admin.holiday-overview.table')

    {{-- Modal Form --}}
    @include('partials.admin.holiday-overview.modal')

    {{-- The Delete Modal --}}
    @include('partials.admin.holiday-overview.delete')

</div>
