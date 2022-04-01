<!-- Users Management -->
<div class="nav-headers">
    {{ __('Settings') }}
</div>

<!-- Users Options -->
<x-jet-dropdown-link href="{{ route('settings-address-types') }}" :active="request()->routeIs('settings-address-types')">
    {{ __('Address Types') }}
</x-jet-dropdown-link>

<!-- Users Options -->
<x-jet-dropdown-link href="{{ route('settings-job-statuses') }}" :active="request()->routeIs('settings-job-statuses')">
    {{ __('Job Statuses') }}
</x-jet-dropdown-link>
