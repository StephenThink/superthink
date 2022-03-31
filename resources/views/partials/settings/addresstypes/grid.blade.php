<div class="md:hidden flex flex-wrap space-x-2">
    @if ($data->count())
    @foreach ($data as $item)
    <x-jet-button wire:click="eventShow('{{ $item->id }}')">
        {{ $item->name }}
    </x-jet-button>
    @endforeach
    @else
    <div>
        <div class=" px-6 py-4 w-full">No Results Found</div>
    </div>
    @endif
</div>
