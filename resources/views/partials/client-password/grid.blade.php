<div class="grid grid-cols-1 md:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column">
            <div>Client</div>
            <div>Title</div>
            <div>URL</div>
            <div>Username</div>
            <div>Password</div>
        </div>

        <div class="grid-right-column">
            <div>{{ $item->clients->name }}</div>
            <div>{{ $item->title }}</div>
            <div>{{ $item->url }}</div>
            <div>{{ $item->login }}</div>
            <div>{{ $item->password }}</div>
        </div>
    </div>
    @endforeach
    @else
    <div>
        <div class="px-6 py-4 w-full">No Results Found</div>
    </div>
    @endif
</div>
