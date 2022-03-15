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
