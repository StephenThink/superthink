<div class="grid grid-cols-1 md:grid-cols-2 lg:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column">
            <div>Name</div>
            <div>Email</div>
            <div>Roles</div>
            <div>Hourly Rate</div>
        </div>

        <div class="grid-right-column">
            <div>{{ $item->name }}</div>
            <div>{{ $item->email }}</div>
            <div class="flex space-x-1 flex-wrap">
                @foreach ($item->roles as $role)
                <div class="grid-li-list">
                    {{ $role->name }}
                </div>
                @endforeach
            </div>
            <div>@if ($item->hourly_rate)
                £{{ number_format($item->hourly_rate,2) }}
                @else
                    Not Set
                @endif</div>

        </div>
    </div>
    @endforeach
    @else
    <div>
        <div class="px-6 py-4 w-full">No Results Found</div>
    </div>
    @endif
</div>
