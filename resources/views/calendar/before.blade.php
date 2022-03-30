<div class="p-2">

    <div class="px-4 py-3">

        @foreach ($errors->get('start') as $message)
        {{$message}}
        @endforeach

        </div>

    <div class="flex justify-between">
        <h2 class="text-2xl">{{ $this->startsAt->format('F Y') }}</h2>

<div class="inline-flex rounded-md shadow-sm" role="group">
    <button wire:click="goToPreviousMonth" type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-white bg-header-dark rounded-l-lg border border-gray-200 hover:text-yellow focus:z-10 focus:ring-2 focus:ring-yellow focus:text-yellow">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-4 h-4 fill-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
    Prev
    </button>
    <button wire:click="goToCurrentMonth" type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-white bg-header-dark border-t border-b border-gray-200 hover:text-yellow focus:z-10 focus:ring-2 focus:ring-yellow focus:text-yellow">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
    Today
    </button>
    <button wire:click="goToNextMonth" type="button" class="inline-flex items-center py-2 px-4 text-sm font-medium text-white bg-header-dark rounded-r-md border border-gray-200 hover:text-yellow focus:z-10 focus:ring-2 focus:ring-yellow focus:text-yellow">

    Next
    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4 fill-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
      </svg>
    </button>
    </div>

    </div>
</div>
