@can('is-holiday-manager')

<div class="nav-headers">
    {{ __('Manage Holidays') }}
</div>

<!-- Holiday Options -->
<x-jet-dropdown-link href="{{ route('holidays-overview') }}" :active="request()->routeIs('holidays-overview')">
    {{ __('Holidays Overview') }}
</x-jet-dropdown-link>

@endcan
