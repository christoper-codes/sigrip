<?php

namespace App\Livewire\Employee;

use App\Exports\UsersTemplateExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Upload extends Component
{

    public function downloadTemplate()
    {
        return Excel::download(new UsersTemplateExport, 'neurra_users_template.xlsx');
    }

    public function render()
    {
        return view('livewire.employee.upload');
    }
}
