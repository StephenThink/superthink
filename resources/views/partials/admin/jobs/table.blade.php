<div class="hidden md:flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Job Name</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Job Number</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Budget</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($data->count())
                            @foreach ($data as $item)
                                <tr>


                                    <td class="px-6 py-2 ">{{ $item->job_name }}</td>
                                    <td class="px-6 py-2 ">{{ $item->job_number }}</td>
                                    <td class="px-6 py-2 ">£0 / <span
                                            class="text-green-800">£{{ number_format($item->budget, 2, '.', ',') }}</span>
                                    </td>
                                    <td class="px-6 py-2 "><span wire:click="toggleStatuses({{ $item->id }})"
                                            class="flex items-center cursor-pointer hover:text-yellow ">@include(
                                                'partials.svgs.status.' .
                                                    $item->statuses->icon
                                            )</span>
                                    </td>
                                    <td class="px-6 py-2 flex justify-end">
                                        @if ($item->status_id != 4)
                                            <x-jet-button class="ml-2 !bg-yellow"
                                                wire:click="archiveJob({{ $item->id }})">
                                                @include(
                                                    'partials.svgs.status.archived',
                                                    ['classes' => 'table-button text-header-dark']
                                                )
                                            </x-jet-button>
                                        @endif
                                        <x-jet-button class="ml-2"
                                            wire:click="updateShowModal({{ $item->id }})">
                                            @include('partials.svgs.update')
                                        </x-jet-button>
                                        <x-jet-danger-button class="ml-2"
                                            wire:click="deleteShowModal({{ $item->id }})">
                                            @include('partials.svgs.trash')
                                        </x-jet-danger-button>
                                    </td>
                                </tr>
                                @if (count($item->jobItems) > 0)
                                    <tr>
                                        <th>Item</th>
                                        <th>Hours</th>
                                        <th>Blank</th>
                                        <th>Cost</th>
                                        <th class="">Status</th>
                                    </tr>
                                    @foreach ($item->jobItems as $i)
                                        <tr>
                                            <td class="px-6 py-2 text-center">{{ $i->description }}</td>
                                            <td class="px-6 py-2"></td>
                                            <td class="px-6 py-2"></td>
                                            <td class="px-6 py-2"></td>
                                            <td class="px-6 py-2 flex justify-end mr-4">@include(
                                                'partials.svgs.status.' . $i->statuses->icon
                                            )</td>
                                        </tr>
                                    @endforeach
                                @endif
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

<div class="tailwind-pagination">
    {{ $data->links() }}
</div>

@include('partials.admin.jobs.grid')
