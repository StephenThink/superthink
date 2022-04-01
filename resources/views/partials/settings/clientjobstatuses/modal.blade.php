<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Clients Form') }}
    </x-slot>

    <x-slot name="content">

        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('Name of Status') }}" />
            <x-jet-input wire:model="name" id="" class="block mt-1 w-full" type="text" />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
