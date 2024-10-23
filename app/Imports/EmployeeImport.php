<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToCollection, ToModel, WithChunkReading, WithHeadingRow
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
        \Log::info('Row keys:', array_keys($row));
        \Log::info('Row content:', $row);

        if (!isset($row['email']) || !isset($row['name']) || !isset($row['phone']) || !isset($row['position'])) {
            \Log::error('One or more required keys are missing in the row', $row);
            return;
        }

        $employee = Employee::updateOrCreate(
            ['email' => $row['email']],
            [
                'id' => $row['id'],
                'name' => $row['name'],
                'phone' => $row['phone'],
                'position' => $row['position'],
            ]
        );

        \Log::info($employee->wasRecentlyCreated ? 'Created new employee' : 'Updated existing employee', ['email' => $row['email']]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
