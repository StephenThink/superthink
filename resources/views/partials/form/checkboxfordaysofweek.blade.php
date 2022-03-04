<div class="mt-4">
    <label class="flex items-center">
        <span class="input-label mr-2 w-24">Monday</span>
        <x-jet-checkbox wire:model.defer="monday" :value="$monday"/>
    </label>
    </div>
    <div class="mt-4">
        <label class="flex items-center">
            <span class="input-label mr-2 w-24">Tuesday</span>
            <x-jet-checkbox wire:model.defer="tuesday" :value="$tuesday"/>
        </label>
        </div>
        <div class="mt-4">
            <label class="flex items-center">
                <span class="input-label mr-2 w-24">Wednesday</span>
                <x-jet-checkbox wire:model.defer="wednesday" :value="$wednesday"/>
            </label>
        </div>
        <div class="mt-4">
            <label class="flex items-center">
                <span class="input-label mr-2 w-24">Thursday</span>
                <x-jet-checkbox wire:model.defer="thursday" :value="$thursday"/>
            </label>
        </div>
        <div class="mt-4">
            <label class="flex items-center">
                <span class="input-label mr-2 w-24">Friday</span>
                <x-jet-checkbox wire:model.defer="friday" :value="$friday"/>
            </label>
        </div>
        <div class="mt-4">
            <label class="flex items-center">
                <span class="input-label mr-2 w-24">Saturday</span>
                <x-jet-checkbox wire:model.defer="saturday" :value="$saturday"/>
            </label>
        </div>
        <div class="mt-4">
            <label class="flex items-center">
                <span class="input-label mr-2 w-24">Sunday</span>
                <x-jet-checkbox wire:model.defer="sunday" :value="$sunday"/>
            </label>
        </div>
