<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Clients Form') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="job_name" value="{{ __('Job Name') }}" />
            <x-jet-input wire:model="job_name" id="" class="block mt-1 w-full" type="text" />
            @error('job_name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="job_number" value="{{ __('Job Number') }}" />
            <x-jet-input wire:model="job_number" id="" class="block mt-1 w-full" type="text" />
            @error('job_number') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="budget" value="{{ __('Budget') }}" />
            <x-jet-input wire:model="budget" id="" class="block mt-1 w-full" type="text" />
            @error('budget') <span class="error">{{ $message }}</span> @enderror
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

        @if ($modelId)
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-danger-button>
        @else
            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Create') }}
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
