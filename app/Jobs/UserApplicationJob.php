<?php

namespace App\Jobs;

use App\Models\Application;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UserApplicationJob implements ShouldQueue
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
        public bool $store = true,
    )
    {
       $this->onQueue('employees');
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->store) {
            $users = User::where('department_id', $this->department_id)
                ->where('company_id', $this->company_id)
                ->get();

            foreach ($users as $user) {
                $this->application->users()->syncWithoutDetaching([
                    $user->id => ['is_active' => true]
                ]);
            }
        }

        if(! $this->store){
            $this->application->users()->detach();
        }
    }
}
