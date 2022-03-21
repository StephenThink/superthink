<!-- Users Management -->
<div class="nav-headers">
    {{ __('Trashed') }}
</div>

<!-- Users Options -->
<x-jet-dropdown-link href="{{ route('users-trashed') }}" :active="request()->routeIs('users-trashed')">
    {{ __('Trashed Users') }}
</x-jet-dropdown-link>

<!-- Users Options -->
<x-jet-dropdown-link href="{{ route('messages-trashed') }}" :active="request()->routeIs('messages-trashed')">
    {{ __('Trashed Messages') }}
</x-jet-dropdown-link>
