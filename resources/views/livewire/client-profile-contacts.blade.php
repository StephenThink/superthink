<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Add Staff Member') }}
        </x-jet-button>
    </div>

    <div wire:poll>
        @if ($data->count())
        <div class="grid grid-cols-3 gap-2">
            @foreach ($data as $item)
                <div class="grid grid-flow-row border border-gray-800 rounded-xl shadow-lg p-2 space-y-2 content-between">
                    <div class="border p-2 border-gray-600 rounded-xl">

                        <div>{{ $item->staff_name }} - {{ $item->staff_position }}</div>
                        <div><a href="tel:{{ $item->staff_number }}">{{ $item->staff_number }}</a></div>
                        <div><a href="mailto:{{ $item->staff_email }}">{{ $item->staff_email }}</a></div>
                    </div>
                    @if (isset($item->staff_notes) && $item->staff_notes != "")
                    <div class="border p-2 border-gray-600 rounded-xl bg-gray-200">
                        <div>{!! $item->staff_notes !!}</div>

                    </div>
                    @endif
                    <div class="flex justify-between">
                        <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                            {{ __('Update') }}
                        </x-jet-button>
                        <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                            {{ __('Delete') }}
                        </x-jet-button>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <div>Sorry, there are no staff members associated with this company.</div>
        @endif

    </div>


    {{-- Modal Form --}}
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
                            <trix-editor
                                class="trix-content"
                                x-ref="trix"
                                wire:model.debounce.100000ms="staff_notes"
                                wire:key="trix-content-unique-key"
                            ></trix-editor>
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
                </x-jet-danger-button>
            @else
                <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- The Delete Modal --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Modal Title') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this item?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Item') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
