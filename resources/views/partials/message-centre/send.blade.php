<x-jet-dialog-modal wire:model="sendModalFormVisible">
    <x-slot name="title">
        {{ __('New Message') }}
    </x-slot>

    <x-slot name="content">

        <div class="mt-4">
            <x-jet-label for="user_id" value="{{ __('To') }}" />
            <select wire:model="user_id" id="" class="input-dropdown">
                <option value="user_id">-- Select a Staff Member --</option>
                @foreach ($users as $sm)
                {{-- Checks to make sure you cant send a message to yourself --}}
                @if (auth()->user()->id != $sm->id)
                    <option value="{{$sm->id}}">{{$sm->name}}</option>
                @endif
                @endforeach
            </select>
            @error('user_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-jet-label for="subject" value="{{ __('Subject') }}" />
            <x-jet-input wire:model="subject" id="" class="block mt-1 w-full" type="text" />
            @error('subject') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <x-jet-label for="message" value="{{ __('Notes') }}" />
            <div class="rounded-md shadow-sm">
                <div class="mt-1 bg-white">
                    <div class="body-content" wire:ignore>
                        <trix-editor
                            class="trix-content"
                            x-ref="trix"
                            wire:model.debounce.100000ms="message"
                            wire:key="trix-content-unique-key"
                        ></trix-editor>
                    </div>
                </div>
            </div>
            @error('message') <span class="error">{{ $message }}</span> @enderror
        </div>


    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('sendModalFormVisible')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>


        <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
            {{ __('Send') }}
            </x-jet-button>

    </x-slot>
</x-jet-dialog-modal>
