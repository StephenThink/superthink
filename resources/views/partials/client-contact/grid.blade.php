<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1">
    @if ($data->count())
    @foreach ($data as $item)
    <div class="grid-mobile-view">
        <div class="grid-left-column">
            <div>Name</div>
            <div>Position</div>
            <div>Telephone</div>
            <div>E-Mail</div>
            @if (isset($item->staff_notes) && $item->staff_notes != "")
            <div>Notes</div>
            @endif
            <div></div>
        </div>

        <div class="grid-right-column">
            <div>{{ $item->staff_name }}</div>
            <div>{{ $item->staff_position }}</div>
            <div><a href="tel:{{ $item->staff_number }}">{{ $item->staff_number }}</a></div>
            <div><a href="mailto:{{ $item->staff_email }}">{{ $item->staff_email }}</a></div>
            @if (isset($item->staff_notes) && $item->staff_notes != "")
            <div>{!! $item->staff_notes !!}</div>
            @endif
            <div class="pb-2">
                <x-jet-button class="" wire:click="updateShowModal({{ $item->id }})">
                    {{ __("Edit")}}
                </x-jet-button>
                <x-jet-danger-button class="" wire:click="deleteShowModal({{ $item->id }})">
                    {{ __("Delete")}}

                    </x-jet-button>
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
