<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Trashed Messages') }}
        </h2>
    </x-slot>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner-inverted">
                @livewire('trashed.messages')
            </div>
        </div>
    </div>
</x-app-layout>
