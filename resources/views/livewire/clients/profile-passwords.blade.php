<div wire:poll.10000ms>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($client->title) }}
        </h2>
    </x-slot>
    <div class="p-6">
        <div class="flex items-center justify-between px-4 py-3 text-right sm:px-6">
            <div class="text-2xl p-2">
                Passwords
            </div>

            <x-jet-button wire:click="createShowModal({{$client->id}})">
                {{ __('Add Password') }}
            </x-jet-button>
        </div>

@include('partials.client-password.table')
    </div>

    {{-- Modal Form --}}
    @include('partials.client-password.modal')


    {{-- The Delete Modal --}}
    @include('partials.client-password.delete')


</div>
