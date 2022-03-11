<div class="p-6">
    <div class="flex items-center justify-between ">
        <div class="px-4 py-3">
        @include('partials.alerts.alerts')
        </div>

        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
            <x-jet-button wire:click="createShowModal">
                {{__('Create')}}
            </x-jet-button>
            @if ($trashedCount > 0)
            <x-jet-button class="ml-2" wire:click="goToTrashedUsers()">
                {{__('Trash')}}
            </x-jet-button>
            @endif

        </div>
   </div>

    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model.debounce.300ms="search" type="text"
                class="search-input"
                placeholder="Search Users...">
        </div>
        <div class="w-1/6 relative mx-1">
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
        <div class="w-1/6 relative mx-1">
            <select wire:model.lazy="orderAsc"
                class="search-dropbox"
                id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

            </div>
        </div>
        <div class="w-1/6 relative mx-1">
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
                                    <x-jet-button wire:click="updateShowModal({{ $item->id }})">
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

    {{-- Create Modal Form --}}
    <x-jet-dialog-modal wire:model="modalCreateFormVisible">
        <x-slot name="title">
            {{ __('Create') }}
        </x-slot>

        <x-slot name="content">
            <div class="form-grid-2">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input wire:model.defer="name" id="" class="block mt-1 w-full" type="text" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('E-Mail') }}" />
                <x-jet-input wire:model.defer="email" id="" class="block mt-1 w-full" type="email" />
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-grid-2">
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input wire:model.defer="password" id="" class="block mt-1 w-full" type="password" />
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="passwordConfirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input wire:model.defer="passwordConfirmation" id="" class="block mt-1 w-full" type="password" />
                @error('passwordConfirmation') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
            <div class="form-grid-2">
            <div class="mt-4">
                <x-jet-label for="dateStarted" value="{{ __('Start Date') }}" />
                <x-jet-input wire:model.defer="dateStarted" id="" class="block mt-1 w-full" type="date" />
                @error('dateStarted') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                {{-- <x-jet-label for="role" value="{{ __('Role') }}" />
                <select wire:model.defer="role" id=""
                    class="input-dropdown">
                    <option value="">-- Select a Role --</option>
                    @foreach (App\Models\User::userRoleList() as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('role') <span class="error">{{ $message }}</span> @enderror --}}

                @foreach ($roles as $role)
                <div class="mt-1">
                    <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="selectedRole.{{ $role->id}}"  class="form-checkbox h-6 w-6 text-green-500">
                         <span class="ml-3 text-sm">{{ $role->name }}</span>
                     </label>
                </div>
                @endforeach


            </div>
        </div>
        @include('partials.form.checkboxfordaysofweek')

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalCreateFormVisible')" wire:loading.attr="disabled">
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

    {{-- Update Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Update Form') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input wire:model="name" id="" class="block mt-1 w-full" type="text" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="dateStarted" value="{{ __('Start Date') }}" />
                <x-jet-input wire:model.defer="dateStarted" id="" class="block mt-1 w-full" type="date" />
                @error('dateStarted') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select wire:model="role" id=""
                    class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">-- Select a Role --</option>
                    @foreach (App\Models\User::userRoleList() as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('role') <span class="error">{{ $message }}</span> @enderror
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

    {{-- The Delete Modal --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete ') }} {{$this->nameOfDeletedUser}} {{ __(' from the Users Table') }}
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
