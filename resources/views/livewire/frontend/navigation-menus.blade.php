<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>
    @if ($data->count())
    <div class="search-bar">
        <div class="search-base-settings md:w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="search-input"placeholder="Search Nav Menus...">
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model="orderBy" class="search-dropbox" id="grid-state">
                <option value="type">Type</option>
                <option value="label">Label</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model="orderAsc" class="search-dropbox" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
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
    @endif
    {{-- The data table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sequence</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Label</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Url</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-6 py-2">{{ $item->type }}</td>
                                        <td class="px-6 py-2">{{ $item->sequence }}</td>
                                        <td class="px-6 py-2">{{ $item->label }}</td>
                                        <td class="px-6 py-2">
                                            <a class="text-indigo-600 hover:text-indigo-900"
                                               target="_blank"
                                               href="{{ url( $item->slug )}}"
                                            >
                                                {{ $item->slug }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-2 flex justify-end">
                                            <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                                @include('partials.svgs.update')
                                            </x-jet-button>
                                            <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                                @include('partials.svgs.trash')
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

    <br/>
    {{ $data->links() }}

    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Navigation Menu Item') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="label" value="{{ __('Label') }}" />
                <x-jet-input wire:model="label" id="label" class="block mt-1 w-full" type="text" />
                @error('label') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm h-10">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        {{ URL::to('/')}}/
                    </span>
                    <input wire:model="slug" class="form-input flex-1 block w-full border border-gary-300 rounded-none rounded-r-md transition duration-150 ease-in-out pl-2 sm:text-sm sm:leading-5" placeholder="url-slug">
                </div>
                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-grid-2">
                <div class="mt-4">
                    <x-jet-label for="sequence" value="{{ __('Sequence') }}" />
                    <x-jet-input wire:model="sequence" id="sequence" class="block mt-1 w-full" type="text" />
                    @error('sequence') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="sequence" value="{{ __('Type') }}" />
                    <select wire:model="type" class="input-dropdown">
                        <option value="SidebarNav">SidebarNav</option>
                        <option value="TopNav">TopNav</option>
                    </select>
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
            {{ __('Delete Page') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this navigation item?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Navigation Item') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
