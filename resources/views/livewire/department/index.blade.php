<div>
     <x-appearance.livewiretable
        :headers="$headers"
        search_placeholder="{{ __('Nombre del departamento') }}"
        :total_results="$total_results"
        :current_page="$current_page"
        :total_pages="$total_pages"
        :paginated_items="$paginated_items"
        :sort_field="$sort_field"
        :sort_direction="$sort_direction"
        >
        <x-slot:table>
            @foreach ($paginated_items as $department)
                <tr>
                    <td class="p-4">{{ $department['name'] }}</td>
                    <td class="p-4">{{ $department['manager']['name'] ?? 'Sin administrador' }}</td>
                    <td class="p-4">{{ $department['email'] ?? 'Sin email' }}</td>
                    <td class="p-4">{{ $department['description'] ?? 'Sin descripción' }}</td>
                    <td class="p-4">{{ $department['created_at'] }}</td>
                    <td class="p-4">
                        <x-appearance.badge status="active" />
                    </td>
                </tr>
            @endforeach
        </x-slot:table>
     </x-appearance.livewiretable>

    <div class="mt-10">
        <flux:heading size="lg">{{ __('Aplicaciones activas') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Seleccione una aplicacion para ver más detalles') }}</flux:text>
    </div>
</div>
