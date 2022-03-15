<div class="p-6">
    <div class="flex items-center justify-between ">
        <div class="px-4 py-3">
            @include('partials.alerts.alerts')
        </div>


        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

            @if (count($staffmembers) > 0)
            <x-jet-button wire:click="createShowModal">
                {{ __('Create') }}
            </x-jet-button>
            @endif

        </div>
    </div>

    {{-- The data table --}}
    @include('partials.admin.staff.table')

    {{-- Modal Form --}}
    @include('partials.admin.staff.modal')


    {{-- Removed as i dont want the user to delete workdays as, they can just remove them when they delete the user --}}
    {{-- The Delete Modal --}}
    {{-- @include('partials.admin.staff.delete') --}}
</div>
