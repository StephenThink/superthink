<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                @livewire('messages.messages')
            </div>
        </div>
    </div>


    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                @livewire('staff.current-user-holidays')
            </div>
        </div>
    </div>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                <livewire:calendars.holiday-calendar
                    week-starts-at="1"
                    before-calendar-view="calendar/before"
                    />

            </div>
        </div>
    </div>
</x-app-layout>
