<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings, FromQuery, WithChunkReading
{
    public function collection()
    {
        return Employee::select('id', 'name', 'email', 'phone', 'postiton')->get();
    }

    public function query()
    {
        return Employee::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Position',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
