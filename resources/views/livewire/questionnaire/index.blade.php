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
            @foreach ($paginated_items as $questionnaire)
                <tr>
                    <td class="p-4">{{ $questionnaire['name'] }}</td>
                    <td class="p-4">{{ $questionnaire['category']['name'] }}</td>
                    <td class="p-4">{{ $questionnaire['category']['description'] }}</td>
                    <td class="p-4"><flux:button variant="filled">{{ __('Ver detalles') }}</flux:button></td>
                    <td class="p-4"><flux:button variant="filled">{{ __('Ver detalles') }}</flux:button></td>
                    <td class="p-4">{{ $questionnaire['created_at'] }}</td>
                    <td class="p-4">
                        <x-appearance.badge status="active" />
                    </td>
                    <td class="p-4">
                        <flux:field variant="inline">
                           <flux:switch wire:click="updateStatus({{ $questionnaire['id'] }})" />
                        </flux:field>
                    </td>
                </tr>
            @endforeach
        </x-slot:table>
     </x-appearance.livewiretable>
</div>
