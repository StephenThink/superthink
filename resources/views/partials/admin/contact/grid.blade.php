<div class="grid grid-cols-1 md:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column">
            <div>Name</div>
            <div>Client</div>
            <div>Telephone</div>
            <div>E-mail</div>
        </div>

        <div class="grid-right-column">
            <div>{{ $item->staff_name }} </div>
            <div>{{ $item->clients->name }} - {{ $item->staff_position }}</div>
            <div>{{ $item->staff_number }}</div>
            <div><a href="mailto:{{ $item->staff_email }}">{{ $item->staff_email }}</a></div>
        </div>
        @endforeach
        @else
        <div>
            <div class="px-6 py-4 w-full">No Results Found</div>
        </div>
        @endif
    </div>
</div>
