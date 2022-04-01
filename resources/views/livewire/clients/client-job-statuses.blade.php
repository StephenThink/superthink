<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Address Types') }}
    </h2>
</x-slot>

<div class="p-6">

    <div class="flex items-center">
        <div class="px-4 py-3">
        @include('partials.alerts.alerts')
        </div>
   </div>

    {{-- The data table --}}
   @include('partials.settings.clientjobstatuses.table')

    {{-- Modal Form --}}
    @include('partials.settings.clientjobstatuses.modal')


</div>
