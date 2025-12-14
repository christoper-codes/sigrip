<div class="relative">
    <section class="mt-10">
         <flux:text>
            <span class="text-primary">{{ __('¡Buena tarde!') }} </span>
            @auth
                <span> {{ auth()->user()->name }} </span>
            @endauth
        </flux:text>
        <div class="space-y-4">
            <div class="py-2 px-4 mt-16 rounded-full text-center text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 inline-block mx-auto">
                {{ $company_name }}
            </div>
           <h1 class="text-4xl max-w-4xl uppercase">
                {{ $questionnaire['name'] }}</span>
            </h1>
            <flux:text class="mt-2">
                {{ __('Tu opinión impulsa nuestra mejora continua.') }}
            </flux:text>
        </div>
        <div class="space-y-4 mt-16">
            <div class="flex items-center gap-1">
                <flux:icon.clock variant="mini"/>
                <flux:text>
                    {{ __('Expiración: ') . $application['expiration_date'] }}
                </flux:text>
            </div>
            <div class="flex flex-col lg:flex-row lg:flex-wrap lg:items-center justify-start gap-3 max-w-4xl">
                @foreach ($questionnaire['instructions'] as $instruction)
                    <div class="py-2 px-4 rounded-full text-center text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 w-max">
                        <span class="inline">
                            {{ __($instruction) }}
                        </span>
                    </div>
                @endforeach
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
                <flux:field class="w-full max-w-xl">
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
                <flux:field class="w-full max-w-xl">
                    <flux:label>{{ __('¿Te has sentido estresado/a en el trabajo este mes?') }}</flux:label>
                    <flux:radio.group name="" class="mt-2 ml-1">
                        <flux:radio value="1" label="Sí, constantemente" />
                        <flux:radio value="2" label="Sí, a veces " />
                        <flux:radio value="3" label="No" />
                    </flux:radio.group>
                    <flux:error name="" class="!mt-0"/>
                </flux:field>
                <flux:field class="w-full max-w-xl">
                    <flux:label>{{ __('Describe tu estado emocional este mes') }}</flux:label>
                    <flux:textarea name="" resize="none" class="mt-2 ml-1"/>
                    <flux:error name=""/>
                </flux:field>
            </div>
        </div>
    </section>
</div>
