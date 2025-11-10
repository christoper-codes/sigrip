<div class="w-full flex flex-col gap-5">
    <div class="w-full lg:w-1/3">
        <flux:input icon="magnifying-glass" placeholder="{{ __('Buscar...') }}" />
    </div>
    <div class="overflow-hidden w-full overflow-x-auto rounded-lg border border-light-variant dark:border-dark-variant">
        <table class="w-full text-left text-sm">
            <thead class="border-b bg-light-variant dark:bg-dark-variant text-sm border-light-variant dark:border-dark-variant">
                <tr>
                    <th class="p-4">{{ __('Nombre') }}</th>
                    <th class="p-4">{{ __('Correo Electrónico') }}</th>
                    <th class="p-4">{{ __('Estatus') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-light-variant dark:divide-dark-variant">
                <tr>
                    <td class="p-4">Alice Brown</td>
                    <td class="p-4">alice.brown@gmail.com</td>
                    <td class="p-4">
                        <div class="border-2 border-green-500 text-green-500 rounded-full py-2 px-4 inline-block text-center text-xs">
                            {{ __('Activo') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Bob Johnson</td>
                    <td class="p-4">johnson.bob@outlook.com</td>
                    <td class="p-4">
                        <div class="border-2 border-red-500 text-red-500 rounded-full py-2 px-4 inline-block text-center text-xs">
                            {{ __('Inactivo') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">Sarah Adams</td>
                    <td class="p-4">s.adams@gmail.com</td>
                    <td class="p-4">
                        <div class="border-2 border-red-500 text-red-500 rounded-full py-2 px-4 inline-block text-center text-xs">
                            {{ __('Inactivo') }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="w-full flex flex-col md:flex-row md:items-center justify-between">
        <flux:heading>{{ __('Resultados:') }} 10</flux:heading>
        <div class="flex items-center justify-between md:justify-around gap-5">
            <flux:text class="mt-2">{{ __('Página 1 de 2') }}</flux:text>
            <div class="flex items-center gap-2">
                <flux:button variant="primary">{{ __('Prev') }}</flux:button>
                <flux:button variant="primary">{{ __('Next') }}</flux:button>
            </div>
        </div>
    </div>
</div>
