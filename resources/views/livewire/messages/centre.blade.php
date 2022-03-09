<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Message Center') }}
    </h2>
</x-slot>


<div class="p-6">
    {{-- <div class="flex items-center justify-end py-3 text-right space-x-2">
        <x-jet-button wire:click="createShowModal">
            {{ __('Send') }}
        </x-jet-button>
        <x-jet-button wire:click="viewAllMessages">
            {{ __('All Messages') }}
        </x-jet-button>
        <x-jet-button wire:click="viewUnreadMessages">
            {{ __('Unread Messages') }}
        </x-jet-button>
        <x-jet-button wire:click="">
            {{ __('Read Messages') }}
        </x-jet-button>
        <x-jet-danger-button class="" wire:click="deleteShowModal()">
            {{ __('Delete All Read Messages') }}
            </x-jet-danger-button>
    </div> --}}



    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Read</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    From</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Message</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-2">
                                    @if ($item->read)
                                    @include('partials.svgs.openmail')
                                    @else
                                    @include('partials.svgs.mail')
                                    @endif
                                </td>
                                <td class="px-6 py-2 flex flex-col">
                                    <div>{{$item->created_at->toFormattedDateString() }}</div>
                                    <div>{{$item->created_at->format('H:i') }}</div>
                                </td>
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
                                    </x-jet-danger-button>
                                    @else
                                    <x-jet-button wire:click="modalFormVisible({{ $item->id }})">
                                        @include('partials.svgs.read')
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


    {{-- The Delete Modal --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete All Read Messages') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete these items?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Item') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Message Modal --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ $this->subject }}
        </x-slot>

        <x-slot name="content">






        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>


            <x-jet-button class="ml-2" wire:click="trash" wire:loading.attr="disabled">
                {{ __('Delete') }}
                </x-jet-button>

        </x-slot>
    </x-jet-dialog-modal>







</div>


