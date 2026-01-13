<div>
    <x-appearance.livewiretable
        :headers="$headers"
        search_placeholder="{{ __('Nombre de la aplicación') }}"
        :total_results="$total_results"
        :current_page="$current_page"
        :total_pages="$total_pages"
        :paginated_items="$paginated_items"
        :sort_field="$sort_field"
        :sort_direction="$sort_direction"
        >
        <x-slot:table>
            @foreach ($paginated_items as $application)
                <tr>
                    <td class="p-4">{{ ucfirst(str_replace('-', ' ', explode('-', $application['slug'], -1) ? implode('-', explode('-', $application['slug'], -1)) : $application['slug'])) }}</td>
                    <td class="p-4">{{ $application['start_date'] }}</td>
                    <td class="p-4">{{ $application['expiration_date'] }}</td>
                    <td class="p-4">
                        <flux:button href="{{ route('application.show', ['slug' => $application['slug']]) }}" icon="clipboard-document-list" class="border! border-primary! bg-primary/10!">{{ __('Aplicar') }}</flux:button>
                    </td>
                    <td class="p-4">
                        @if($application['pivot']['is_active'])
                            <flux:icon.x-circle class="size-7 text-red-500"/>
                        @else
                            <flux:icon.check-circle class="size-7 text-green-500"/>
                        @endif
                    </td>
                    <td class="p-4">
                        @if(! $application['pivot']['is_active'])
                            {{ $application['pivot']['updated_at'] }}
                        @else
                            {{ __('Sin fecha') }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot:table>
     </x-appearance.livewiretable>
</div>
