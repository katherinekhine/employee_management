<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Imports\EmployeeImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function export()
    {
        // return Excel::download(new EmployeesExport, 'employees.xlsx');
        $file_name = 'employees_' . time() . '.xlsx';
        return Excel::store(new EmployeesExport, $file_name);
    }

    public function import_excel()
    {
        return view('import_excel');
    }

    public function import_excel_post(Request $request)
    {
        // dd($request->all());
        Excel::import(new EmployeeImport, $request->file('excel_file')->store('temp'));
        return response()->json(['success' => 'File imported successfully']);

        // return redirect()->back();
    }
}
