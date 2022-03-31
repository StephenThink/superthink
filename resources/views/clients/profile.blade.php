<x-app-layout>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                @livewire('clients.profile-contacts', ['id' => $id])
            </div>
        </div>
    </div>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                @livewire('clients.address', ['id' => $id])
            </div>
        </div>
    </div>

    <div class="content-outer">
        <div class="content-block">
            <div class="content-inner">
                @livewire('clients.profile-passwords', ['id' => $id])
            </div>
        </div>
    </div>

</x-app-layout>
