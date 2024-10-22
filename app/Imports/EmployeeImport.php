<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmployeeImport implements ToCollection, ToModel, WithChunkReading
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
        // $this->current++;
        // if ($this->current > 1) {
        //     // $count = Employee::where('email', '=', $row[2])->count();
        //     // if (empty($count)) {
        //     //     $employee = new Employee();
        //     //     $employee->id = $row[0];
        //     //     $employee->name = $row[1];
        //     //     $employee->email = $row[2];
        //     //     $employee->phone = $row[3];
        //     //     $employee->postiton = $row[4];
        //     //     $employee->save();
        //     // }

        //     Employee::updateOrCreate(
        //         ['email' => $row[2]],
        //         [
        //             'id' => $row[0],
        //             'name' => $row[1],
        //             'phone' => $row[3],
        //             'postiton' => $row[4],
        //         ]
        //     );
        // }

        // if (Employee::where('email', $row[2])->exists()) {
        //     \Log::info('Employee already exists', ['email' => $row[2]]);
        //     return null;
        // }

        // return new Employee([
        //     'id' => $row[0],
        //     'name' => $row[1],
        //     'email' => $row[2],
        //     'phone' => $row[3],
        //     'postiton' => $row[4],
        // ]);

        $id = $row[0];
        $email = $row[2];

        $employee = Employee::updateOrCreate(
            ['email' => $email],
            [
                'id' => $id,
                'name' => $row[1],
                'phone' => $row[3],
                'postiton' => $row[4],
            ]
        );

        \Log::info($employee->wasRecentlyCreated ? 'Created new employee' : 'Updated existing employee', ['email' => $email]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
