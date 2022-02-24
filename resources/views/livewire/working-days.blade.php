<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">

        @if (count($staffmembers) > 0)
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
        @endif

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
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Monday</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tuesday</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Wednesday</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Thursday</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Friday</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Saturday</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sunday</th>

                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-6 py-2">{{ $item->user->name }}</td>
                                        <td class="px-6 py-2 " wire:click="invertDay({{ $item->id}}, 'monday')">
                                        @if ($item->monday)
                                            <div class="bg-green-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">Yes</div>
                                        @else
                                            <div class="bg-red-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">No</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2" wire:click="invertDay({{ $item->id}}, 'tuesday')">
                                        @if ($item->tuesday)
                                            <div class="bg-green-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">Yes</div>
                                        @else
                                            <div class="bg-red-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">No</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2" wire:click="invertDay({{ $item->id}}, 'wednesday')">
                                        @if ($item->wednesday)
                                            <div class="bg-green-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">Yes</div>
                                        @else
                                            <div class="bg-red-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">No</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2" wire:click="invertDay({{ $item->id}}, 'thursday')">
                                        @if ($item->thursday)
                                            <div class="bg-green-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">Yes</div>
                                        @else
                                            <div class="bg-red-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">No</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2" wire:click="invertDay({{ $item->id}}, 'friday')">
                                        @if ($item->friday)
                                            <div class="bg-green-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">Yes</div>
                                        @else
                                            <div class="bg-red-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">No</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2" wire:click="invertDay({{ $item->id}}, 'saturday')">
                                        @if ($item->saturday)
                                            <div class="bg-green-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">Yes</div>
                                        @else
                                            <div class="bg-red-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">No</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2" wire:click="invertDay({{ $item->id}}, 'sunday')">
                                        @if ($item->sunday)
                                            <div class="bg-green-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">Yes</div>
                                        @else
                                            <div class="bg-red-500 px-2 py-1 rounded-lg w-10 flex items-center justify-center">No</div>
                                        @endif
                                    </td>

                                        <td class="px-6 py-2 flex justify-end">

                                            <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                                {{ __('Delete') }}
                                            </x-jet-button>
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
            {{ __('Add Staff Member') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="user_id" value="{{ __('Type') }}" />
                <select wire:model="user_id" id="" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="user_id">-- Select a Staff Member --</option>
                    @foreach ($staffmembers as $sm)
                    <option value="{{$sm->id}}">{{$sm->name}}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
            <label class="flex items-center">
                <x-jet-checkbox wire:model.defer="monday" :value="$monday"/>
                <span class="ml-2 text-sm text-gray-600">Monday</span>
            </label>
            </div>
            <div class="mt-4">
                <label class="flex items-center">
                    <x-jet-checkbox wire:model.defer="tuesday" :value="$tuesday"/>
                    <span class="ml-2 text-sm text-gray-600">Tuesday</span>
                </label>
                </div>
                <div class="mt-4">
                    <label class="flex items-center">
                        <x-jet-checkbox wire:model.defer="wednesday" :value="$wednesday"/>
                        <span class="ml-2 text-sm text-gray-600">Wednesday</span>
                    </label>
                </div>
                <div class="mt-4">
                    <label class="flex items-center">
                        <x-jet-checkbox wire:model.defer="thursday" :value="$thursday"/>
                        <span class="ml-2 text-sm text-gray-600">Thursday</span>
                    </label>
                </div>
                <div class="mt-4">
                    <label class="flex items-center">
                        <x-jet-checkbox wire:model.defer="friday" :value="$friday"/>
                        <span class="ml-2 text-sm text-gray-600">Friday</span>
                    </label>
                </div>
                <div class="mt-4">
                    <label class="flex items-center">
                        <x-jet-checkbox wire:model.defer="saturday" :value="$saturday"/>
                        <span class="ml-2 text-sm text-gray-600">Saturday</span>
                    </label>
                </div>
                <div class="mt-4">
                    <label class="flex items-center">
                        <x-jet-checkbox wire:model.defer="sunday" :value="$sunday"/>
                        <span class="ml-2 text-sm text-gray-600">Sunday</span>
                    </label>
                </div>
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
