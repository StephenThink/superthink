<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    {{-- The data table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Staff Member</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date Start</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date Finish</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Half Day?</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Days Taken</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-6 py-2">{{ $item->users->name }}</td>
                                        <td class="px-6 py-2">{{ \Carbon\Carbon::parse($item->start)->format('D jS M, Y') }}</td>
                                        <td class="px-6 py-2">{{ \Carbon\Carbon::parse($item->end)->format('D jS M, Y') }}</td>
                                        <td class="px-6 py-2">@if ( $item->halfDay  == 1)
                                            Yes
                                        @endif</td>
                                        <td class="px-6 py-2">{{ $item->daysTaken }}</td>
                                        <td class="px-6 py-2 flex justify-end">
                                            <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                                @include('partials.svgs.update')
                                            </x-jet-button>
                                            @if ( $item->start >= now() )
                                            <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                                @include('partials.svgs.trash')
                                            </x-jet-danger-button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No Results Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
    {{ $data->links() }}
    </div>
    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Create') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4" x-data="{ open: @entangle('daysErrorVisible') }">
                <div x-show="open" class="bg-red-200 border border-red-600 text-red-600 p-2 rounded-lg">
                    You dont have enough days to take.
                </div>

            </div>
            <div class="mt-4">
                <x-jet-label for="user_id" value="{{ __('Staff Member') }}" />
                <select wire:model.defer="user_id" id="" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">-- Select a Staff Member --</option>
                    @foreach ($staffMembers as $s)
                    <option value="{{$s->id}}">{{$s->name}} - ( {{$s->leaveDays}} days left )</option>
                    @endforeach

                </select>
                @error('user_id') <span class="error">{{ $message }}</span> @enderror
            </div>
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
            <div class="mt-4">
                <x-jet-label for="halfDay" value="{{ __('Half a Day?') }}" />
                <x-jet-checkbox wire:model.defer="halfDay" id="" class="block mt-1" type="checkbox" />
                @error('halfDay') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="dateAuthorised" value="{{ __('Date Authorised') }}" />
                <x-jet-input wire:model.defer="dateAuthorised" id="" class="block mt-1 w-full" type="date" />
                @error('dateAuthorised') <span class="error">{{ $message }}</span> @enderror
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
