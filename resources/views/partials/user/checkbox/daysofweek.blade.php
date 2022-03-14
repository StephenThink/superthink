<label class="flex items-center justify-between">
    <span class="input-label mr-2 w-56">Monday</span>
    <x-jet-checkbox wire:model.defer="monday" :value="$monday" />
</label>
<label class="flex items-center justify-between">
    <span class="input-label mr-2 w-56">Tuesday</span>
    <x-jet-checkbox wire:model.defer="tuesday" :value="$tuesday" />
</label>
<label class="flex items-center justify-between">
    <span class="input-label mr-2 w-56">Wednesday</span>
    <x-jet-checkbox wire:model.defer="wednesday" :value="$wednesday" />
</label>
<label class="flex items-center justify-between">
    <span class="input-label mr-2 w-56">Thursday</span>
    <x-jet-checkbox wire:model.defer="thursday" :value="$thursday" />
</label>
<label class="flex items-center justify-between">
    <span class="input-label mr-2 w-56">Friday</span>
    <x-jet-checkbox wire:model.defer="friday" :value="$friday" />
</label>
<label class="flex items-center justify-between">
    <span class="input-label mr-2 w-56">Saturday</span>
    <x-jet-checkbox wire:model.defer="saturday" :value="$saturday" />
</label>
<label class="flex items-center justify-between">
    <span class="input-label mr-2 w-56">Sunday</span>
    <x-jet-checkbox wire:model.defer="sunday" :value="$sunday" />
</label>
