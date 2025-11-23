<?php

namespace App\Livewire\Employee;

use App\Exports\EmployeesTemplateExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Upload extends Component
{

    public function downloadTemplate()
    {
        return Excel::download(new EmployeesTemplateExport, 'neura_employees_template.xlsx');
    }

    public function render()
    {
        return view('livewire.employee.upload');
    }
}
