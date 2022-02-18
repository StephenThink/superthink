<div wire:poll class="p-6">
    <div class="text-2xl p-2">
        Messages
    </div>
       {{-- The data table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">From</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Message</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-6 py-2">{{ $item->created_at }}</td>
                                        <td class="px-6 py-2">{{ $item->sender->name }}</td>
                                        <td class="px-6 py-2">
                                            <div class="flex flex-col">
                                                <div> {{ $item->subject }}</div>
                                                <div> {{ $item->message }}</div>
                                            </div>

                                           </td>

                                        <td class="px-6 py-2 flex justify-end">
                                            @if ($item->subject == "Holiday Request")
                                            <x-jet-button wire:click="granted({{ $item->requestedId }}, {{$item->id}})">
                                                {{ __('Grant') }}
                                            </x-jet-button>
                                            <x-jet-danger-button class="ml-2" wire:click="denyed({{ $item->requestedId }}, {{$item->id}})">
                                                {{ __('Deny') }}
                                            </x-jet-button>
                                            @else
                                            <x-jet-button wire:click="readMessage({{ $item->id }})">
                                                {{ __('Read') }}
                                            </x-jet-button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No Results Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        {{ $data->links() }}
    </div>


</div>
