<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ $this->subject }}
    </x-slot>

    <x-slot name="content">

        {!! $this->message !!}





    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Close') }}
        </x-jet-secondary-button>


        <x-jet-button class="ml-2" wire:click="trash" wire:loading.attr="disabled">
            {{ __('Delete') }}
            </x-jet-button>

    </x-slot>
</x-jet-dialog-modal>
