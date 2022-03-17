<div class="grid grid-cols-1 md:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column">
            <div>Name</div>
            <div>Description</div>
        </div>

        <div class="grid-right-column">
            <div>{{ $item->name }}</div>
            <div>{{ $item->description }}</div>
        </div>
    </div>
    @endforeach
    @else
    <div>
        <div class="px-6 py-4 w-full">No Results Found</div>
    </div>
    @endif
</div>
