<div class="p-6">
    <div class="flex items-center justify-between ">
        <div class="px-4 py-3">
        @include('partials.alerts.alerts')
        </div>

        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
            <x-jet-button wire:click="goToUsers">
                {{__('Back to Users')}}
            </x-jet-button>
        </div>
   </div>

    <div class="search-bar">
        <div class="search-base-settings md:w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text"
                class="search-input"
                placeholder="Search Users...">
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model.lazy="orderBy"
                class="search-dropbox"
                id="grid-state">
                <option value="name">Name</option>
                <option value="role">Role</option>
                <option value="email">Email</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model.lazy="orderAsc"
                class="search-dropbox"
                id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model.lazy="perPage"
                class="search-dropbox"
                id="grid-state">
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
                                    Name</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-2">{{ $item->name }}</td>
                                <td class="px-6 py-2">{{ Str::title($item->role) }}</td>
                                <td class="px-6 py-2">{{ $item->email }}</td>
                                <td class="px-6 py-2 flex justify-end">
                                    <x-jet-button wire:click="restore({{ $item->id }})">
                                        {{ __('Restore') }}
                                    </x-jet-button>
                                    <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                        {{ __('Destroy') }}
                                        </x-jet-danger-button>
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

    {{-- The Delete Modal --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete ') }} {{$this->nameOfDeletedUser}} {{ __(' from the Users Table') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this item, you will never get it back?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="forceDelete" wire:loading.attr="disabled">
                {{ __('Delete Item') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
