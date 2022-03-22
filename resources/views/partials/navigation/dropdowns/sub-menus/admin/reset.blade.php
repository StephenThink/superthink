@can('is-holiday-manager')

<div class="nav-headers">
    {{ __('Reset') }}
</div>

<!-- Holiday Options -->
<x-jet-dropdown-link href="{{ route('reset-holidays') }}" :active="request()->routeIs('reset-holidays')">
    {{ __('Reset Holidays') }}
</x-jet-dropdown-link>

@endcan
