<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Passwords for the Vault') }}
    </x-slot>
    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="client_id" value="{{ __('Type') }}" />
            <select wire:model="client_id" id="" class="input-dropdown">
                <option value="">-- Find a Client--</option>
                @foreach ($clients as $client)
                <option value="{{$client->id}}">{{ $client->name}}</option>

                @endforeach

            </select>
            @error('client_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="title" value="{{ __('Title') }}" />
            <x-jet-input wire:model="title" id="" class="block mt-1 w-full" type="text" />
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input wire:model="password" id="" class="block mt-1 w-full" type="text" />
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="login" value="{{ __('Login') }}" />
            <x-jet-input wire:model="login" id="" class="block mt-1 w-full" type="text" />
            @error('login') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="url" value="{{ __('URL Address') }}" />
            <x-jet-input wire:model="url" id="" class="block mt-1 w-full" type="text" />
            @error('url') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
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
