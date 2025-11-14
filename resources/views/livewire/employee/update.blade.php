<div>
    <flux:checkbox.group wire:model="employee_roles">
        @foreach ($roles as $role)
            <flux:checkbox
                value="{{ $role['id'] }}"
                label="{{ $role['name'] }}"
                description="{{ $role['description'] }}"
            />
        @endforeach
    </flux:checkbox.group>
</div>
