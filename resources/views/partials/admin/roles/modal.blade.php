<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Role') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="name" value="{{ __('Role Name') }}" />
            <x-jet-input wire:model="name" id="" class="block mt-1 w-full" type="text" />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="description" value="{{ __('Brief Description') }}" />
            <x-jet-input wire:model="description" id="" class="block mt-1 w-full" type="text" />
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

        @if ($modelId)
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
        @else
            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Create') }}
            </x-jet-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
