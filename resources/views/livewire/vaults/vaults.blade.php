<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="search-input" placeholder="Search Passwords...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderBy" class="search-dropbox" id="grid-state">

                <option value="title">Title</option>
                <option value="login">Login</option>
                <option value="url">URL</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderAsc" class="search-dropbox" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="perPage" class="search-dropbox" id="grid-state">
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

                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Login</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Password</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">URL</th>

                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                <tr>
                                    <td class="px-6 py-2">{{ $item->clients->title }} - {{ $item->description }}</td>

                                </tr>
                                <tr>
                                    <td class="px-6 py-2">{{ $item->title }}</td>
                                    <td class="px-6 py-2">{{ $item->login }}</td>
                                    <td class="px-6 py-2">{{ $item->password }}</td>
                                    <td class="px-6 py-2">{{ $item->url }}</td>

                                    <td class="px-6 py-2 flex justify-end">
                                        <x-jet-button class="ml-2" wire:click="updateShowModal({{ $item->id }})">
                                            @include('partials.svgs.update')
                                        </x-jet-button>
                                        <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                            @include('partials.svgs.trash')
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
            {{ __('Passwords for the Vault') }}
        </x-slot>
        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="client_id" value="{{ __('Type') }}" />
                <select wire:model="client_id" id="" class="input-dropdown">
                    <option value="">-- Find a Client--</option>
                    @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{ $client->title}}</option>

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