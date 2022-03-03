<x-app-layout>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                @livewire('client-profile-contacts', ['id' => $id])
            </div>
        </div>
    </div>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                @livewire('client-profile', ['id' => $id])
            </div>
        </div>
    </div>

</x-app-layout>
