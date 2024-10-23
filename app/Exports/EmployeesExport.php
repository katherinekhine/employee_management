<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, FromQuery, WithChunkReading, WithMapping
{
    protected $startRow;
    public function collection()
    {
        return Employee::select('id', 'name', 'email', 'phone', 'position')->get();

        $this->startRow = $startRow;
    }

    public function query()
    {
        // return Employee::query();
        return Employee::query()->skip($this->startRow)->take($this->chunkSize());
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

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->name,
            $employee->email,
            $employee->phone,
            $employee->position,
        ];
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}
