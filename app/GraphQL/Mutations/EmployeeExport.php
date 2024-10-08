<?php

namespace App\GraphQL\Mutations;

use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeExport
{
    public function export($root, $args, $context, $info)
    {
        $fileName = 'employees.xlsx';
        return Excel::store(new EmployeesExport, $fileName, 'public') ? asset('storage/' . $fileName) : null;
    }
}
