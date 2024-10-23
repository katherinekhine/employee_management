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

        // return Employee::all();
        $perPage = $args['first'] ?? 10;
        $page = $args['page'] ?? 1;

        return Employee::paginate($perPage, ['*'], 'page', $page);
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
            'position' => $args['position'],
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
            'position' => $args['position'] ?? $employee->position,
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
