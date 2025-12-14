<div>
    <section class="mt-10">
         <flux:text>
            <span class="text-primary">{{ __('¡Buena tarde!') }}</span> {{ __('Christopher Patiño Santos') }}
        </flux:text>
        <div class="space-y-4">
            <div class="py-2 px-4 mt-16 rounded-full text-center text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 inline-block mx-auto">
                {{ __('Victoria LLC') }}
            </div>
           <h1 class="text-4xl max-w-4xl uppercase">
                {{ __('Escaneo emocional mensual (NOM-035) ') }}</span>
            </h1>
            <flux:text class="mt-2">
                {{ __('Tu opinión impulsa nuestra mejora continua.') }}
            </flux:text>
        </div>
        <div class="space-y-4 mt-16">
            <div class="flex items-center gap-1">
                <flux:icon.clock variant="mini"/>
                <flux:text>
                    {{ __('Expiración: 03/01/2026 00:00') }}
                </flux:text>
            </div>
            <div class="flex flex-col lg:flex-row lg:flex-wrap lg:items-center justify-start gap-3 max-w-4xl">
                <div class="py-2 px-4 rounded-full text-center text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 w-max">
                    <span class="inline">
                        {{__('Responde con sinceridad')}}
                    </span>
                </div>
                <div class="py-2 px-4 rounded-full text-center text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 w-max">
                    <span class="inline">
                        {{__('No hay respuestas correctas o incorrectas')}}
                    </span>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-20">
        <div>
            <div class="p-5 rounded-2xl border border-light-variant dark:border-dark-variant bg-light-variant dark:bg-dark-variant">
                <flux:heading size="lg" class="text-primary">{{ __('Escaneo general') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Evaluación del estado emocional general y factores básicos de bienestar laboral') }}</flux:text>
            </div>
            <div class="mt-7 flex flex-col gap-10">
                <flux:field class="w-full max-w-3xl">
                    <flux:label>{{ __('¿Cómo te sentiste en general este mes?') }}</flux:label>
                    <flux:radio.group name="" class="mt-2 ml-1">
                        <flux:radio value="1" label="Muy mal" />
                        <flux:radio value="2" label="Mal" />
                        <flux:radio value="3" label="Neutral" />
                        <flux:radio value="4" label="Bien" />
                        <flux:radio value="5" label="Muy bien" />
                    </flux:radio.group>
                    <flux:error name="" class="!mt-0"/>
                </flux:field>
                <flux:field class="w-full max-w-3xl">
                    <flux:label>{{ __('¿Te has sentido estresado/a en el trabajo este mes?') }}</flux:label>
                    <flux:radio.group name="" class="mt-2 ml-1">
                        <flux:radio value="1" label="Sí, constantemente" />
                        <flux:radio value="2" label="Sí, a veces " />
                        <flux:radio value="3" label="No" />
                    </flux:radio.group>
                    <flux:error name="" class="!mt-0"/>
                </flux:field>
            </div>
        </div>
    </section>
</div>
