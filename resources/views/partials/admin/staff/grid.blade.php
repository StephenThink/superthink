<div class="grid grid-cols-1 lg:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column ">
            <div>Staff</div>
            <div class="pt-3">Day</div>

        </div>

        <div class="grid-right-column">
            <div class="text-center">{{ $item->user->name }}</div>
            <div class="grid grid-cols-7 w-full text-center ">
                <div class="flex justify-center text-sm">Mon</div>
                <div class="flex justify-center text-sm">Tue</div>
                <div class="flex justify-center text-sm">Wed</div>
                <div class="flex justify-center text-sm">Thu</div>
                <div class="flex justify-center text-sm">Fri</div>
                <div class="flex justify-center text-sm">Sat</div>
                <div class="flex justify-center text-sm">Sun</div>
            </div>
            <div class="grid grid-cols-7 w-full  text-center ">
                <div class="-ml-2 flex justify-center pb-2">
                    @if ($item->monday)
                    @include('partials.svgs.yes')
                    @else
                    @include('partials.svgs.no')
                    @endif
                </div>
                <div class="-ml-2 flex justify-center">
                    @if ($item->tuesday)
                    @include('partials.svgs.yes')
                    @else
                    @include('partials.svgs.no')
                    @endif
                </div>
                <div class="-ml-2 flex justify-center">
                    @if ($item->wednesday)
                    @include('partials.svgs.yes')
                    @else
                    @include('partials.svgs.no')
                    @endif
                </div>
                <div class="-ml-2 flex justify-center">
                    @if ($item->thursday)
                    @include('partials.svgs.yes')
                    @else
                    @include('partials.svgs.no')
                    @endif
                </div>
                <div class="-ml-2 flex justify-center">
                    @if ($item->friday)
                    @include('partials.svgs.yes')
                    @else
                    @include('partials.svgs.no')
                    @endif
                </div>
                <div class="-ml-2 flex justify-center">
                    @if ($item->saturday)
                    @include('partials.svgs.yes')
                    @else
                    @include('partials.svgs.no')
                    @endif
                </div>
                <div class="-ml-2 flex justify-center">
                    @if ($item->sunday)
                    @include('partials.svgs.yes')
                    @else
                    @include('partials.svgs.no')
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div>
        <div class="px-6 py-4 w-full">No Results Found</div>
    </div>
    @endif
</div>
