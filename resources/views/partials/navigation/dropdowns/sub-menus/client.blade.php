@can('is-client-manager')

<!-- Client Management -->
<div class="nav-headers">
    {{ __('Manage Clients') }}
</div>

<!-- Client Options -->
<x-jet-dropdown-link href="{{ route('clients') }}" :active="request()->routeIs('clients')">
    {{ __('Clients') }}
</x-jet-dropdown-link>

<!-- Client Contacts -->
<x-jet-dropdown-link href="{{ route('client-contacts') }}" :active="request()->routeIs('client-contacts')">
    {{ __('Contacts') }}
</x-jet-dropdown-link>

<!-- Client Options -->
<x-jet-dropdown-link href="{{ route('vaults') }}" :active="request()->routeIs('vaults')">
    {{ __('Vault') }}
</x-jet-dropdown-link>
@endcan
