<div class="grid grid-cols-1 md:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column w-1/4">
            <div>Name</div>
            <div>Budget</div>
        </div>



        <div class="grid-middle-column">
            <div>{{ $item->job_name }} @if ($item->job_number)
                - {{ $item->job_number }}
            @endif
        </div>
            <div>£0 / <span class="text-green-800">£{{ number_format($item->budget, 2, '.',',') }}</span></div>
        </div>


        <div class="grid-right-column !w-[3.75rem]">
            <div><span wire:click="toggleStatuses({{ $item->id }})" class="flex items-center cursor-pointer hover:text-yellow ">@include('partials.svgs.status.'.$item->statuses->icon)</span></div>

        </div>
    </div>
        @endforeach
        @else
        <div>
            <div class="px-6 py-4 w-full">No Results Found</div>
        </div>
        @endif
</div>
