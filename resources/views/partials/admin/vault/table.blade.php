<div class="flex-col hidden lg:flex">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Title</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                URL</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Login</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Password</th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($data->count())
                        @foreach ($data as $item)
                        <tr>
                            <td colspan="5" class="px-6 py-2 w-full border-t-header-dark border-t-2  ">
                                {{ $item->clients->name }} @if ($item->description)
                                - {{ $item->description }}
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $item->title }}</td>
                            <td class="px-6 py-2 whitespace-nowrap"><a href="{{ $item->url }}" target="_blank"
                                    class="vault-link">{{ $item->url }}</a></td>
                            <td class="px-6 py-2 group"><span class="tooltip-text">Copy to Clipboard?</span>
                                <div id="{{ $item->login }}"
                                    onclick="copyToClipboard('{{ $item->login }}');return false;" class="vault-link">
                                    {{ $item->login }}</div>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap group"><span class="tooltip-text">Copy to
                                    Clipboard?</span>
                                <div id="{{ $item->password }}"
                                    onclick="copyToClipboard('{{ $item->password }}');return false;" class="vault-link">
                                    {{ $item->password }}</div>
                            </td>

                            <td class="px-6 py-2 whitespace-nowrap flex justify-end">
                                <x-jet-button class="ml-2" wire:click="updateShowModal({{ $item->id }})">
                                    @include('partials.svgs.update')
                                </x-jet-button>
                                <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
                                    @include('partials.svgs.trash')
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

<div class="mt-5 hidden md:flex">
    {{ $data->links() }}
</div>



@include('partials.admin.vault.grid')

<script defer>
    function copyToClipboard(id) {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
    }

</script>
