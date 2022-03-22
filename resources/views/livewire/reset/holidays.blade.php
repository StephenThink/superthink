<div class="p-6">
    <div class="flex items-center justify-between p-2">
        <div class="px-4 py-3">
        @include('partials.alerts.alerts')
        </div>
        <x-jet-button wire:click="updateAll">
            {{ __('Update All Holidays') }}
        </x-jet-button>
   </div>

   <div class="flex-col hidden lg:flex">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Date Started</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Entitlement</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($data->count())
                        @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-2">{{ $item->name }}</td>
                            <td class="px-6 py-2">{{ \Carbon\Carbon::parse($item->dateStarted)->toFormattedDateString() }} - {{ \Carbon\Carbon::parse($item->dateStarted)->diffInYears() }} year(s)</td>
                            <td class="px-6 py-2">{{ $item->entitlement }}

                            </td>
                            <td class="px-6 py-2 flex justify-end">
                                <x-jet-button wire:click="updateHolidays({{ $item->id }},{{ $item->entitlement }})">
                                    @include('partials.svgs.update')
                                </x-jet-button>
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













</div>
