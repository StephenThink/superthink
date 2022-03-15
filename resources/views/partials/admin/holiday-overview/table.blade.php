@if (count($data))

@foreach ($data as $key => $items)
<div class="ml-3 text-2xl p-2">
    {{ $key }}
</div>

@if(count($items))
{{-- The data table --}}
<div class="flex flex-col mb-2">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Date Start</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Date Finish</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Half Day?</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Days Taken</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Authorised</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($items as $item)
                        <tr>
                            <td class="px-6 py-2">{{ \Carbon\Carbon::parse($item->start)->format('D jS M, Y') }}
                            </td>
                            <td class="px-6 py-2">{{ \Carbon\Carbon::parse($item->end)->format('D jS M, Y') }}</td>
                            <td class="px-6 py-2">@if ( $item->halfDay == 1)
                                Yes
                                @endif</td>
                            <td class="px-6 py-2">{{ $item->daysTaken }}</td>
                            <td class="px-6 py-2">{{ $item->dateAuthorised }} by {{ $item->authorisedBys->name }}
                            </td>
                            <td class="px-6 py-2 flex justify-end">
                                @if ($item->pending)
                                <x-jet-button wire:click="granted({{$item->id}})">
                                    {{ __('Grant') }}
                                </x-jet-button>
                                <x-jet-danger-button class="ml-2" wire:click="denyed({{$item->id}})">
                                    {{ __('Deny') }}
                                </x-jet-button>
                                @else
                                <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                    @include('partials.svgs.update')
                                </x-jet-button>
                                @if ( $item->start >= now() )
                                <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                    @include('partials.svgs.trash')
                                    </x-jet-button>
                                    @endif

                                @endif
                            </td>
                        </tr>
                        @empty


                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div>This person has not taken any holidays yet.</div>
@endif
@endforeach
@else
@endif
