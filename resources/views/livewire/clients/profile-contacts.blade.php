<div class="p-6" wire:poll.10000ms>
    <div class="flex items-center justify-between px-4 py-3 text-right sm:px-6">
        <div class="text-2xl p-2">
            Staff Members
        </div>

        <x-jet-button wire:click="createShowModal">
            {{ __('Add Staff Member') }}
        </x-jet-button>
    </div>

    @include('partials.client-contact.grid')


    {{-- Modal Form --}}
    @include('partials.client-contact.modal')

    {{-- The Delete Modal --}}
    @include('partials.client-contact.delete')
</div>
