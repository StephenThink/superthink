<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Message Center') }}
    </h2>
</x-slot>


<div class="p-6">
    <div class="flex items-center justify-end py-3 text-right space-x-2">
        <x-jet-button wire:click="createShowModal">
            {{ __('Send') }}
        </x-jet-button>
        <x-jet-button wire:click="viewAllMessages">
            {{ __('All Messages') }}
        </x-jet-button>
        <x-jet-button wire:click="viewUnreadMessages">
            {{ $unreadCount }}{{ __(' Unread Messages') }}
        </x-jet-button>
        <x-jet-button wire:click="">
            {{ __('Read Messages') }}
        </x-jet-button>
        <x-jet-danger-button class="" wire:click="deleteShowModal()">
            {{ __('Delete All Read Messages') }}
            </x-jet-danger-button>
    </div>



    @include('partials.message-centre.inbox')

    {{-- The Delete Modal --}}
    @include('partials.message-centre.delete')

    {{-- Message Modal --}}
    @include('partials.message-centre.send')


    {{-- Read Mail in inbox --}}
    @include('partials.message-centre.mail')

</div>


