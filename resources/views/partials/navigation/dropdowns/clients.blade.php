<x-jet-dropdown align="right" width="60">
    <x-slot name="trigger">
        <span class="inline-flex rounded-md">
            <button type="button" class="nav-dropdown">
                {{ __('Clients') }}

                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="w-60">


            @foreach (\App\Models\Client::all() as $item)
            <x-jet-dropdown-link href="{{ route('client-profile', $item->id) }}">
                {{ __($item->title) }}
            </x-jet-dropdown-link>
            @endforeach



        </div>
    </x-slot>
</x-jet-dropdown>
