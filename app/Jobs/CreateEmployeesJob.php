<?php

namespace App\Jobs;

use App\Events\NotificationEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class CreateEmployeesJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $employees,
        public int $organization_id,
        public int $company_id,
        public int $department_id,
        public ?string $department_name,
        public array $user_roles,
        public int $user_id,
    )
    {
       $this->onQueue('employees');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            foreach ($this->employees as $employee) {
                $user = User::create([
                    'name' => $employee['nombre_completo'],
                    'email' => $employee['correo_electronico'],
                    'password' => bcrypt($employee['password']),
                    'department_id' => $this->department_id,
                    'company_id' => $this->company_id,
                    'organization_id' => $this->organization_id,
                    'metadata' => ['notifications' => 0],
                ]);
                $user->userRoles()->attach($this->user_roles ?? []);
            }
            DB::commit();
            event(new NotificationEvent(
                notification: [
                    'type' => 'success',
                    'title' => __('Empleados creados'),
                    'message' => __('Los nuevos empleados fueron creados correctamente para el departamento: :department', ['department' => $this->department_name ?? 'N/A']),
                    'url' => route('employee.index'),
                    'user_id' => $this->user_id,
                ],
                user_id: $this->user_id,
            ));
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
