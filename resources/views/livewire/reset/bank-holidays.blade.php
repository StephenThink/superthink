<div class="p-6">
    <div class="flex items-center justify-between p-2">
        <div class="px-4 py-3">
        @include('partials.alerts.alerts')
        </div>
        <div class="flex space-x-2">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
        @if($BHS == 0)
        <x-jet-button wire:click="insertBankHolidays">
            {{ __('Assign Bank Holidays to Users') }}
        </x-jet-button>
        @else
        <x-jet-danger-button wire:click="removeBankHolidays">
            {{ __('Remove Bank Holidays Assigned to Users') }}
        </x-jet-danger-button>
        @endif
    </div>
   </div>

    <div class="search-bar">
        <div class="search-base-settings md:w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="search-input" placeholder="Search Holidays...">
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model.lazy="orderBy" class="search-dropbox" id="grid-state">
                <option value="description">Holiday</option>
                <option value="bankdate">Date</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model.lazy="orderAsc" class="search-dropbox" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model.lazy="perPage" class="search-dropbox" id="grid-state">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
    </div>

    {{-- The data table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Holiday</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-2">{{ $item->description }}</td>
                                <td class="px-6 py-2">{{ $item->bankdate }}</td>
                                <td class="px-6 py-2 flex justify-end">
                                    <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                        {{ __('Update') }}
                                    </x-jet-button>
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
            {{ __('Add New Day') }}
        </x-slot>

        <x-slot name="content">
            <div class="form-grid-2">
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Day') }}" />
                    <x-jet-input wire:model="description" id="" class="block mt-1 w-full" type="text" />
                    @error('description') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="bankdate" value="{{ __('Date') }}" />
                    <x-jet-input wire:model="bankdate" id="" class="block mt-1 w-full" type="date" />
                    @error('bankdate') <span class="error">{{ $message }}</span> @enderror
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
