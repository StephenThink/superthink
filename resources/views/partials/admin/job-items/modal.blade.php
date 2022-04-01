<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Clients Form') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="job_id" value="{{ __('Job') }}" />
            <select wire:model.defer="job_id" id="" class="input-dropdown">
                <option value="">-- Select a Job --</option>
                @foreach ($jobs as $j)
                <option value="{{$j->id}}">{{$j->job_name}}</option>
                @endforeach

            </select>
            @error('job_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-jet-input wire:model="description" id="" class="block mt-1 w-full" type="text" />
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">

        <x-jet-label for="status_id" value="{{ __('Status') }}" />
        <select wire:model.defer="status_id" id="" class="input-dropdown">
            <option value="">-- Select a Status --</option>
            @foreach ($jobStatus as $s)
            <option value="{{$s->id}}">{{$s->name}}</option>
            @endforeach

        </select>
        @error('status_id') <span class="error">{{ $message }}</span> @enderror
        </div>
</x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

        @if ($modelId)
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-danger-button>
        @else
            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Create') }}
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
