<div class="grid grid-cols-1 md:grid-cols-2 lg:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class=" rounded-lg bg-gray-200">
        <div class="grid-row-style">
            <div class="grid-row-header rounded-tl-lg">Client</div>
            <div class="grid-row-data ">{{ $item->clients->name }}</div>
        </div>
        <div class="grid-row-style  ">
            <div class="grid-row-header">Title</div>
            <div class="grid-row-data">{{ $item->title }}</div>
        </div>
        <div class="grid-row-style  ">
            <div class="grid-row-header">URL</div>
            <div class="grid-row-data">{{ $item->url }}</div>
        </div>
        <div class="grid-row-style  ">
            <div class="grid-row-header">Username</div>
            <div class="grid-row-data">{{ $item->login }}</div>
        </div>
        <div class="grid-row-style ">
            <div class="grid-row-header rounded-bl-lg">Password</div>
            <div class="grid-row-data">{{ $item->password }}</div>
        </div>
    </div>
    @endforeach
    @else
    <div>
        <div class="px-6 py-4 w-full">No Results Found</div>
    </div>
    @endif
</div>
