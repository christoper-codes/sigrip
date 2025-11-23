<div>
    <form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
        <flux:field>
            <flux:label>{{ __('Selecciona un departamento') }}</flux:label>
            <flux:select class="!h-12" name="department" wire:model.live="department">
                <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                @foreach ($departments as $department)
                    <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="department" class="!mt-0"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Nombre completo') }}</flux:label>
            <flux:input name="name" wire:model="name" icon="briefcase" placeholder="{{ __('John Doe') }}"/>
            <flux:error name="name" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Correo electrónico') }}</flux:label>
            <flux:input type="email" name="email" wire:model="email" icon="envelope" placeholder="{{ __('john.doe@outlook.com') }}"/>
            <flux:error name="email" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Contraseña') }}</flux:label>
            <flux:input name="password" type="password" wire:model="password" icon="lock-closed" placeholder="●●●●●●●●" viewable />
            <flux:error name="password" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Confirmar Contraseña') }}</flux:label>
            <flux:input name="password_confirmation" type="password" wire:model="password_confirmation" icon="lock-closed" placeholder="●●●●●●●●" viewable />
            <flux:error name="password_confirmation" />
        </flux:field>
        <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
    </form>
</div>
