<?php

namespace App\GraphQL\Resolvers;

use App\Models\Employee;

class EmployeeResolver
{
    public function resolveEmployees($root, $args, $context, $info)
    {

        if (!auth()->check()) {
            throw new \Exception('Unauthorized');
        }


        return Employee::all();
    }

    public function resolveEmployee($root, $args, $context, $info)
    {

        if (!auth()->check()) {
            throw new \Exception('Unauthorized');
        }


        return Employee::findOrFail($args['id']);
    }

    public function createEmployee($root, $args, $context, $info)
    {

        if (!auth()->check()) {
            throw new \Exception('Unauthorized');
        }


        return Employee::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'phone' => $args['phone'],
            'postiton' => $args['postiton'],
        ]);
    }

    public function updateEmployee($root, $args, $context, $info)
    {
        if (!auth()->check()) {
            throw new \Exception('Unauthorized');
        }

        $employee = Employee::findOrFail($args['id']);
        $employee->update([
            'name' => $args['name'] ?? $employee->name,
            'email' => $args['email'] ?? $employee->email,
            'phone' => $args['phone'] ?? $employee->phone,
            'postiton' => $args['postiton'] ?? $employee->postiton,
        ]);

        return $employee;
    }

    public function deleteEmployee($root, $args, $context, $info)
    {
        if (!auth()->check()) {
            throw new \Exception('Unauthorized');
        }

        $employee = Employee::findOrFail($args['id']);
        $employee->delete();

        return $employee;
    }
}
