<?php

namespace App\Jobs;

use App\Models\Application;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CreateUserApplicationJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $department_id,
        public int $company_id,
        public Application $application,
    )
    {
       $this->onQueue('employees');
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::where('department_id', $this->department_id)
            ->where('company_id', $this->company_id)
            ->get();
        foreach ($users as $user) {
            $this->application->users()->attach($user->id, ['is_active' => true]);
        }
    }
}
