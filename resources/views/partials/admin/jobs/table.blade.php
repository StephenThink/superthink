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
                            <td class="px-6 py-2 ">£{{ number_format($item->budget, 2, '.',',') }}</td>
                            <td class="px-6 py-2 ">{{ $item->statuses }}</td>
                            <td class="px-6 py-2 flex justify-end">
                                <x-jet-button class="ml-2" wire:click="updateShowModal({{ $item->id }})">
                                    @include('partials.svgs.update')
                                </x-jet-button>
                                <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                    @include('partials.svgs.trash')
                                    </x-jet-danger-button>
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

<div class="tailwind-pagination">
    {{ $data->links() }}
</div>

@include('partials.admin.jobs.grid')
