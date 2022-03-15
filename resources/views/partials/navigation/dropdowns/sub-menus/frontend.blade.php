<!-- Frontend Management -->
@can('is-frontend-manager')

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

@endcan
