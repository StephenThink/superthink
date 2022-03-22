<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('New Holiday') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4" x-data="{ open: @entangle('daysErrorVisible') }">
            <div x-show="open" class="bg-red-200 border border-red-600 text-red-600 p-2 rounded-lg">
                You dont have enough days to take.
            </div>

        </div>
        <div class="mt-4">
            <x-jet-label for="user_id" value="{{ __('Staff Member') }}" />
            <select wire:model.defer="user_id" id="" class="input-dropdown">
                <option value="">-- Select a Staff Member --</option>
                @foreach ($staffMembers as $s)
                <option value="{{$s->id}}">{{$s->name}} - ( {{$s->leaveDays}} days left )</option>
                @endforeach

            </select>
            @error('user_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-grid-2">
        <div class="mt-4">
            <x-jet-label for="start" value="{{ __('Start Date') }}" />
            <x-jet-input wire:model.defer="start" id="" class="block mt-1 w-full" type="date" />
            @error('start') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="end" value="{{ __('End Date') }}" />
            <x-jet-input wire:model.defer="end" id="" class="block mt-1 w-full" type="date" />
            @error('end') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="form-grid-2">
        <div class="mt-4 ">
            <x-jet-label for="halfDay" value="{{ __('Half a Day?') }}" />
            <x-jet-checkbox wire:model.defer="halfDay" id="" class="input-checkbox w-6 h-6" type="checkbox" />
            @error('halfDay') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="dateAuthorised" value="{{ __('Date Authorised') }}" />
            <x-jet-input wire:model.defer="dateAuthorised" id="" class="block mt-1 w-full" type="date" />
            @error('dateAuthorised') <span class="error">{{ $message }}</span> @enderror
        </div>
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
