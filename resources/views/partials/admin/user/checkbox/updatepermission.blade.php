<div class="mt-1 border border-header-dark rounded-md p-2 px-4">
    {{-- <x-jet-label for="role" value="{{ __('Role') }}" />
    <select wire:model.defer="role" id="" class="input-dropdown">
        <option value="">-- Select a Role --</option>
        @foreach (App\Models\User::userRoleList() as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    @error('role') <span class="error">{{ $message }}</span> @enderror --}}



    @foreach ($roles as $role)

        <div class="">
            <label class="flex items-center justify-between">
                <span class="input-label mr-2">{{ $role->name }} </span>
                <input class="input-checkbox" type="checkbox" wire:model="selectedRole.{{$role->id}}" >
            </label>

        </div>
    @endforeach
</div>
