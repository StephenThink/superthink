@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>

    <div class="bg-header-dark">

        <div class="text-lg text-yellow px-6 py-4 font-bold">
            {{ $title }}
        </div>

        <div class="bg-white px-6 py-4">
            {{ $content }}
        </div>


    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</div>
</x-jet-modal>
