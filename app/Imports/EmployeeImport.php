<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToCollection, ToModel
{
    private $current = 0;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // dd($collection);
    }

    public function model(array $row)
    {
        $this->current++;
        if ($this->current > 1) {
            $count = Employee::where('email', '=', $row[1])->count();
            if (empty($count)) {
                $employee = new Employee();
                $employee->name = $row[1];
                $employee->email = $row[2];
                $employee->phone = $row[3];
                $employee->postiton = $row[4];
                $employee->save();
            }
        }
    }
}
