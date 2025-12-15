<?php

namespace App\Livewire\Application;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Show extends Component
{
    public Application $application;
    public ?string $company_name = null;
    public ?array $questionnaire = null;
    public int $current_theme_step = 0;
    public array $themes = [];
    public ?array $current_theme = null;
    public int $theme_count = 0;
    public int $theme_index = 0;

    public function mount(): void
    {
        $this->questionnaire = $this->application->questionnaire->toArray();
        $this->company_name = $this->application->issuingDepartment->company->name;
        $this->current_theme_step = 0;
        $this->setThemesAndCurrentTheme();
    }

    public function getAvailableThemes(): array
    {
        $themes = $this->questionnaire['metadata']['themes'] ?? [];
        if ($this->questionnaire['metadata']['questionnaire_id'] === 'plan_escaneo_emocional_mensual') {
            $result = [];
            if (isset($themes[0])) {
                $result[] = $themes[0];
            }
            $month = Carbon::now()->month;
            foreach ($themes as $idx => $theme) {
                foreach ($theme['questions'] as $question) {
                    if (isset($question['month']) && $question['month'] == $month) {
                        if ($idx !== 0) {
                            $result[] = $theme;
                        }
                        break 2;
                    }
                }
            }
            return $result;
        }
        return $themes;
    }

    public function setThemesAndCurrentTheme(): void
    {
        $this->themes = $this->getAvailableThemes();
        $this->theme_count = count($this->themes);
        $this->theme_index = $this->current_theme_step;
        $this->current_theme = $this->themes[$this->current_theme_step] ?? null;
    }

    public function nextTheme()
    {
        if ($this->current_theme_step < $this->theme_count - 1) {
            $this->current_theme_step++;
            $this->setThemesAndCurrentTheme();
        }
    }

    public function prevTheme()
    {
        if ($this->current_theme_step > 0) {
            $this->current_theme_step--;
            $this->setThemesAndCurrentTheme();
        }
    }

    public function render()
    {
        return view('livewire.application.show');
    }
}
