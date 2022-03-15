<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Holidays Overview') }}
        </h2>
    </x-slot>


    <div class="flex">
        <div class="w-full">
            <div class="content-outer">
                <div class="content-block">
                    <div class="content-inner">
                        @livewire('holidays.overview')
                    </div>
                </div>
            </div>

            <div class="content-outer hidden xl:block">
                <div class="content-block">
                    <div class="content-inner">
                        <livewire:calendars.all-holidays-calendar drag-and-drop-enabled="true" week-starts-at="1"
                            before-calendar-view="calendar/before" />

                    </div>
                </div>
            </div>
        </div>

        <div class="w-1/4">
            <div class="content-outer">
                <div class="content-block">
                    <div class="content-inner">
                        @livewire('holidays.just-holidays')
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-app-layout>
