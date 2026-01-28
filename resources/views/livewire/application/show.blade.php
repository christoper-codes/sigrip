<div class="relative">
    <section class="mt-10">
        <div
            x-data="{
                greeting: '',
                init() {
                    const hour = new Date().getHours();
                    if (hour >= 5 && hour < 12) {
                        this.greeting = '{{ __('Buenos días') }}';
                    } else if (hour >= 12 && hour < 18) {
                        this.greeting = '{{ __('Buena tarde') }}';
                    } else {
                        this.greeting = '{{ __('Buena noche') }}';
                    }
                }
            }">
            <flux:text>
                <span class="text-primary" x-text="greeting"></span>
                @auth
                    <span> {{ auth()->user()->name }} </span>
                @endauth
            </flux:text>
        </div>
        <div class="space-y-4">
            <div class="py-2 px-4 mt-16 rounded-full text-center text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 inline-block mx-auto">
                {{ $company_name }}
            </div>
            <h1 class="text-4xl max-w-4xl uppercase">
                {{ $questionnaire['name'] }}</span>
            </h1>
            <flux:text class="mt-2">
                {{ __('Solo tomara unos minutos. Tu opinión impulsa nuestra mejora continua.') }}
            </flux:text>
        </div>
        <div class="space-y-4 mt-14">
            <div class="flex items-center gap-1">
                <flux:icon.briefcase variant="mini"/>
                <flux:text>
                    {{ __('Departamento: ') . $department_name }}
                </flux:text>
            </div>
            <div class="flex items-center gap-1">
                <flux:icon.clock variant="mini"/>
                <flux:text>
                    {{ __('Expiración: ') . (dateFormat($application['expiration_date']) ??  __('Sin limite.')) }}
                </flux:text>
            </div>
        </div>
        <div class="mt-14 flex flex-col lg:flex-row lg:flex-wrap lg:items-center justify-start gap-3 max-w-4xl">
            @foreach ($questionnaire['metadata']['instructions'] as $instruction)
                <div class="py-2 px-4 rounded-full text-center text-xs lg:text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 lg:w-max">
                    <span class="inline">
                        {{ __($instruction) }}
                    </span>
                </div>
            @endforeach
        </div>
    </section>
    @if($is_visitor)
        <section class="mt-14 max-w-lg">
            <flux:callout color="yellow" icon="information-circle" heading="{{ __('Estás accediendo a esta aplicación como visitante') }}" />
        </section>
    @endif
    <section
        id="questionnaire-themes"
        class="mt-20"
        style="scroll-margin-top: 70px;"
        x-data="{ first: true }"
        x-effect="
            @this.theme_change;
            if (!first) {
                setTimeout(() => {
                    document.getElementById('questionnaire-themes').scrollIntoView({ behavior: 'auto', block: 'start' });
                }, 100);
            }
            first = false;
        "
        >
        @if ($current_theme)
            <div class="p-5 my-7 rounded-2xl border border-light-variant dark:border-dark-variant bg-light-variant dark:bg-dark-variant">
                <flux:heading size="lg" class="text-primary">{{ __($current_theme['name']) }}</flux:heading>
                @if (!empty($current_theme['description']))
                    <flux:text class="mt-2">{{ __($current_theme['description']) }}</flux:text>
                @endif
            </div>
            <div class="flex flex-col gap-10">
                @foreach ($current_theme['questions'] as $question)
                    <flux:field class="w-full">
                        <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:gap-4">
                            <flux:label>{{ __($question['text']) }}</flux:label>
                            @if(in_array($question['id'], ['gr2_q42', 'gr2_q43', 'gr2_q44']))
                                <div class="py-2 px-2 text-xs border-l-4 border-r-4 border-primary rounded-md">
                                    {{ __('Responder solo \'Sí\' debe brindar servicio a clientes o usuarios') }}
                                </div>
                            @endif
                            @if(in_array($question['id'], ['gr2_q46', 'gr2_q47', 'gr2_q48']))
                                <div class="py-2 px-2 text-xs border-l-4 border-r-4 border-primary rounded-md">
                                    {{ __('Responder solo \'Sí\' eres jefe de otros trabajadores') }}
                                </div>
                            @endif
                        </div>

                        @if (in_array($question['type'], ['select', 'radio_button']) && !empty($question['options']))
                            <flux:radio.group
                                name="answers.{{ $question['id'] }}"
                                wire:model="answers.{{ $question['id'] }}"
                                class="mt-2 ml-1"
                            >
                                @foreach ($question['options'] as $option)
                                    <flux:radio value="{{ $option['value'] }}" label="{{ $option['label'] }}" />
                                @endforeach
                            </flux:radio.group>
                        @elseif ($question['type'] === 'text')
                            <flux:textarea
                                name="answers.{{ $question['id'] }}"
                                wire:model="answers.{{ $question['id'] }}"
                                resize="none"
                                class="mt-2 ml-1"
                            />
                        @endif
                        <flux:error name="answers.{{ $question['id'] }}" class="!mt-0"/>
                    </flux:field>
                @endforeach
            </div>
            <div class="mt-16 flex items-center gap-3">
                <flux:button
                    icon="arrow-left"
                    variant="primary"
                    wire:click="prevTheme"
                    :disabled="$theme_index === 0"
                    >
                    {{ __('Anterior') }}
                </flux:button>
                @if ($theme_index === $theme_count - 1)
                    <flux:button
                        class="border! border-primary! bg-primary/10!"
                        wire:click="submit"
                    >
                        <span wire:loading.remove wire:target="submit" class="flex items-center gap-1.5">
                            {{ __('Finalizar aplicación') }}
                        </span>
                        <span wire:loading wire:target="submit">
                            <x-flux::icon.loading class="size-4! mx-[53.8px]!" />
                        </span>
                    </flux:button>
                @else
                    <flux:button
                        icon:trailing="arrow-right"
                        variant="primary"
                        wire:click="nextTheme"
                        :disabled="$theme_index === $theme_count-1"
                    >
                        {{ __('Siguiente') }}
                    </flux:button>
                @endif
            </div>
             @if($error_message)
                <div class="flex items-start gap-2 mt-5">
                    <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                    <flux:text class="!text-red-500">{{ $error_message }}</flux:text>
                </div>
            @endif
            <div class="flex mt-5">
                <flux:text>{{ __('Preguntas ') }} {{ $current_questions }} {{ __(' de ') }} {{ $total_questions }}</flux:text>
            </div>
        @endif
    </section>
</div>
