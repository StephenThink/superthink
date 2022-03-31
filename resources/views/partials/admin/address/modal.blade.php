<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Clients Form') }}
    </x-slot>

    <x-slot name="content">
        <x-jet-label for="type" value="{{ __('Address Type') }}" />
        <select wire:model.defer="type" id="" class="input-dropdown">
            <option value="">-- Select an Address Type --</option>
            @foreach ($addressTypes as $t)
            <option value="{{$t->id}}">{{$t->name}}</option>
            @endforeach
        </select>
        @error('type') <span class="error">{{ $message }}</span> @enderror
        <div class="mt-4">
            <x-jet-label for="property_name" value="{{ __('Property Name') }}" />
            <x-jet-input wire:model="property_name" id="" class="block mt-1 w-full" type="text" />
            @error('property_name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="property_number" value="{{ __('Property Number') }}" />
            <x-jet-input wire:model="property_number" id="" class="block mt-1 w-full" type="text" />
            @error('property_number') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="address_1" value="{{ __('Address 1') }}" />
            <x-jet-input wire:model="address_1" id="" class="block mt-1 w-full" type="text" />
            @error('address_1') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="address_2" value="{{ __('Address 2') }}" />
            <x-jet-input wire:model="address_2" id="" class="block mt-1 w-full" type="text" />
            @error('address_2') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="town_city" value="{{ __('Town / City') }}" />
            <x-jet-input wire:model="town_city" id="" class="block mt-1 w-full" type="text" />
            @error('town_city') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="county" value="{{ __('County') }}" />
            <x-jet-input wire:model="county" id="" class="block mt-1 w-full" type="text" />
            @error('county') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="post_code" value="{{ __('Post Code') }}" />
            <x-jet-input wire:model="post_code" id="" class="block mt-1 w-full" type="text" />
            @error('post_code') <span class="error">{{ $message }}</span> @enderror
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
