<x-jet-dropdown align="right" width="60">
    <x-slot name="trigger">
        <span class="inline-flex rounded-md">
            <button type="button" class="nav-dropdown">
                {{ __('Admin') }}

                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="w-60">
            <!-- Frontend Management -->
            <div class="nav-headers">
                {{ __('Manage Frontend') }}
            </div>

            <!-- Pages / Nav Options -->

            <x-jet-dropdown-link href="{{ route('pages') }}" :active="request()->routeIs('pages')">
                {{ __('Pages') }}
            </x-jet-dropdown-link>
            <x-jet-dropdown-link href="{{ route('navigation-menus') }}" :active="request()->routeIs('navigation-menus')">
                {{ __('Navigation Menus') }}
            </x-jet-dropdown-link>

@can('is-user-manager')
            <!-- Users Management -->
            <div class="nav-headers">
                {{ __('Manage Users') }}
            </div>

            <!-- Users Options -->
            <x-jet-dropdown-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                {{ __('Users') }}
            </x-jet-dropdown-link>
            <x-jet-dropdown-link href="{{ route('roles') }}" :active="request()->routeIs('roles')">
                {{ __('User Roles') }}
            </x-jet-dropdown-link>

            <x-jet-dropdown-link href="{{ route('workingdays') }}" :active="request()->routeIs('workingdays')">
                {{ __('Staff Work Days') }}
            </x-jet-dropdown-link>
@endcan
            <!-- Users Management -->
            <div class="nav-headers">
                {{ __('Manage Holidays') }}
            </div>

            <!-- Holiday Options -->
            <x-jet-dropdown-link href="{{ route('holidays-overview') }}" :active="request()->routeIs('holidays-overview')">
                {{ __('Holidays Overview') }}
            </x-jet-dropdown-link>

            <!-- Client Management -->
            <div class="nav-headers">
                {{ __('Manage Clients') }}
            </div>

            <!-- Client Options -->
            <x-jet-dropdown-link href="{{ route('clients') }}" :active="request()->routeIs('clients')">
                {{ __('Clients') }}
            </x-jet-dropdown-link>

            <!-- Client Options -->
            <x-jet-dropdown-link href="{{ route('vaults') }}" :active="request()->routeIs('vaults')">
                {{ __('Vault') }}
            </x-jet-dropdown-link>

            <!-- Client Contacts -->
            <x-jet-dropdown-link href="{{ route('client-contacts') }}" :active="request()->routeIs('client-contacts')">
                {{ __('Contacts') }}
            </x-jet-dropdown-link>

        </div>
    </x-slot>
</x-jet-dropdown>
