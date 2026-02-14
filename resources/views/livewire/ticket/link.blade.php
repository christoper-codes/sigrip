<div>
    <flux:modal.trigger name="link-ticket-modal">
        <flux:button icon="share" wire:click="shareTicketLink()" variant="filled">{{ __('Compartir') }}</flux:button>
    </flux:modal.trigger>

    <flux:modal name="link-ticket-modal" class="w-[90%] md:w-full!">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Compartir link publico de incidencias') }}</flux:heading>
                <flux:text class="mt-3">{{ __('Puedes descargar el código QR o copiar el link y compartirlo con los empleados.') }}</flux:text>
            </div>
            <div class="flex flex-col items-center gap-4">
                <img src="{{ Storage::url('qrs/' . $slug . '.svg') }}" alt="QR" class="border w-48 h-48 mx-auto" />
                <a href="{{ Storage::url('qrs/' . $slug . '.svg') }}" download class="mt-2">
                    <flux:button class="cursor-pointer" icon="arrow-down-on-square" variant="outline">{{ __('Descargar') }}</flux:button>
                </a>
                <div class="mt-2 break-all text-center">
                    <div x-data="{ copied: false }" class="flex items-center gap-2">
                        <flux:heading size="lg" class="truncate! w-52! md:w-80! block">{{ $url }}</flux:heading>
                        <flux:icon.clipboard-document class="cursor-pointer" variant="solid" x-show="!copied" @click="navigator.clipboard.writeText('{{ $url }}'); copied = true; setTimeout(() => copied = false, 1500)" />
                        <flux:icon.check variant="solid" x-show="copied" disabled />
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
