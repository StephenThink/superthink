<x-jet-dialog-modal wire:model="modalCreateFormVisible">
    <x-slot name="title">
        {{ __('Create') }}
    </x-slot>

    <x-slot name="content">
        <div class="form-grid-2">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input wire:model.lazy="name" id="" class="block mt-1 w-full" type="text" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('E-Mail') }}" />
                <x-jet-input wire:model.defer="email" id="" class="block mt-1 w-full" type="email" />
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-grid-2">
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input wire:model.defer="password" id="" class="block mt-1 w-full" type="password" />
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="passwordConfirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input wire:model.defer="passwordConfirmation" id="" class="block mt-1 w-full" type="password" />
                @error('passwordConfirmation') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-grid-2">
            <div class="mt-4">
                <x-jet-label for="dateStarted" value="{{ __('Start Date') }}" />
                <x-jet-input wire:model.defer="dateStarted" id="" class="block mt-1 w-full" type="date" />
                @error('dateStarted') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div></div>
        </div>
        <div class="form-grid-2">
            <div class="flex flex-col mt-4">
                <x-jet-label value="{{ __('Roles / Permissions') }}" />
                @include('partials.user.checkbox.permission')

            </div>
            <div class="flex flex-col mt-4">
                <x-jet-label value="{{ __('Working Days') }}" />

                <div class="mt-1 border border-header-dark rounded-md p-2 px-4">
                    @include('partials.user.checkbox.daysofweek')
                </div>

            </div>
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalCreateFormVisible')" wire:loading.attr="disabled">
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
