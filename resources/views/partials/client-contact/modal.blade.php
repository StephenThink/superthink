<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Contact Form') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="staff_name" value="{{ __('Name') }}" />
            <x-jet-input wire:model="staff_name" id="" class="block mt-1 w-full" type="text" />
            @error('staff_name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="staff_position" value="{{ __('Position') }}" />
            <x-jet-input wire:model="staff_position" id="" class="block mt-1 w-full" type="text" />
            @error('staff_position') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="staff_number" value="{{ __('Number') }}" />
            <x-jet-input wire:model="staff_number" id="" class="block mt-1 w-full" type="text" />
            @error('staff_number') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="staff_email" value="{{ __('E-Mail') }}" />
            <x-jet-input wire:model="staff_email" id="" class="block mt-1 w-full" type="text" />
            @error('staff_email') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="staff_notes" value="{{ __('Notes') }}" />
            <div class="rounded-md shadow-sm">
                <div class="mt-1 bg-white">
                    <div class="body-content" wire:ignore>
                        <trix-editor class="trix-content" x-ref="trix" wire:model.debounce.100000ms="staff_notes"
                            wire:key="trix-content-unique-key"></trix-editor>
                    </div>
                </div>
            </div>
            @error('staff_notes') <span class="error">{{ $message }}</span> @enderror
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
        <x-jet-danger-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
            {{ __('Create') }}
        </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
