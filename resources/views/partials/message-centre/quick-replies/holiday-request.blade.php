<x-jet-button wire:click="granted({{ $item->requestedId }}, {{$item->id}})">
    {{ __('Grant') }}
</x-jet-button>
<x-jet-danger-button class="ml-2" wire:click="denyed({{ $item->requestedId }}, {{$item->id}})">
    {{ __('Deny') }}
</x-jet-danger-button>
