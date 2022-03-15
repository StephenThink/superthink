<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Add Staff Member') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="user_id" value="{{ __('Type') }}" />
            <select wire:model="user_id" id="" class="input-dropdown">
                <option value="user_id">-- Select a Staff Member --</option>
                @foreach ($staffmembers as $sm)
                <option value="{{$sm->id}}">{{$sm->name}}</option>
                @endforeach
            </select>
            @error('user_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        @include('partials.admin.user.checkbox.daysofweek')
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>
        <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
            {{ __('Create') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
