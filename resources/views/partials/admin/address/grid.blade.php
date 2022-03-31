<div class="grid grid-cols-1 md:hidden gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column w-1/4">
            <div>Type</div>
            <div>Property Name</div>
            <div>Address</div>
        </div>

        <div class="grid-right-column">
            <div>{{ $item->types->name }} </div>
            <div>{{ $item->property_name }}</div>
            <div>@if( $item->property_number ){{ $item->property_number }}@endif
                @if( $item->address_1 ){{$item->address_1}},<br>@endif
                @if( $item->address_2 ){{$item->address_2}},<br>@endif
                @if( $item->town_city ){{$item->town_city}},<br>@endif
                @if( $item->county ){{$item->county}},<br>@endif
                @if( $item->post_code ){{$item->post_code}}@endif</div>
        </div>
    </div>
        @endforeach
        @else
        <div>
            <div class="px-6 py-4 w-full">No Results Found</div>
        </div>
        @endif
</div>
