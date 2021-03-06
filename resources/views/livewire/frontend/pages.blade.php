<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{__('Create')}}
        </x-jet-button>
    </div>
    @if ($data->count())
    <div class="search-bar">
        <div class="search-base-settings md:w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text" class="search-input"placeholder="Search Pages...">
        </div>
        <div class="search-base-settings md:w-1/6 relative mx-1">
            <select wire:model="orderBy" class="search-dropbox" id="grid-state">
                <option value="title">Title</option>
                <option value="slug">Slug</option>
                <option value="content">Content</option>
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
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Link</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($data->count())
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                {{ $item->title }}
                                                {!! $item->is_default_home ? '<span class="text-green-400 text-xs font-bold">[Default Home Page]</span>':''!!}
                                                {!! $item->is_default_not_found ? '<span class="text-red-400 text-xs font-bold">[Default 404 Page]</span>':''!!}
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                                <a
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                    target="_blank"
                                                    href="{{ URL::to('/'.$item->slug)}}"
                                                >
                                                    {{ $item->slug }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! \Illuminate\Support\Str::limit($item->content, 50, '...') !!}</td>
                                            <td class="px-6 py-4 text-right text-sm">
                                                <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                                    @include('partials.svgs.update')
                                                </x-jet-button>
                                                <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
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
            {{ __('Create a New Page') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title" />
                @error('title') <span class="error">{{ $message }}</span> @enderror

            </div>

            <div class="mt-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm h-10">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-yellow bg-gray-50 text-header-dark text-sm">
                        {{ URL::to('/')}}/
                    </span>
                    <input wire:model="slug" class="flex-1 block w-full border border-header-dark rounded-none rounded-r-md transition duration-150 ease-in-out pl-2 sm:text-sm sm:leading-5 !focus:border-yellow" placeholder="url-slug">
                </div>
                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label>
                    <input class="input-checkbox" type="checkbox" value="{{ $isSetToDefaultHomePage }}" wire:model="isSetToDefaultHomePage"/>
                    <span class="ml-2 text-sm text-gray-600">Set as the default home page</span>
                </label>
            </div>
            <div class="mt-4">
                <label>
                    <input class="input-checkbox" type="checkbox" value="{{ $isSetToDefaultNotFoundPage }}" wire:model="isSetToDefaultNotFoundPage"/>
                    <span class="ml-2 text-sm text-red-600">Set as the default 404 error page</span>
                </label>
            </div>
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Content') }}" />
                <div class="rounded-md shadow-sm">
                    <div class="mt-1 bg-white">
                        <div class="body-content" wire:ignore>
                            <trix-editor
                                class="trix-content"
                                x-ref="trix"
                                wire:model.debounce.100000ms="content"
                                wire:key="trix-content-unique-key"
                            ></trix-editor>
                        </div>
                    </div>
                </div>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>



        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($modelId)
            <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
            @else
            <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                {{ __('Create') }}
            </x-jet-button>
            @endif

        </x-slot>
    </x-jet-dialog-modal>

     {{-- The Delete Modal --}}

     <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Page') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this page? Once the page is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Page') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
