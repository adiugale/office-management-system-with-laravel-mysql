<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;


class EmployeeController extends Controller
{

public function index()
    {
        $employees = Employee::with('company', 'manager')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        $employees = Employee::all();

        return view('employees.create', compact('companies', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'company_id' => 'required'
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        $employees = Employee::where('id', '!=', $id)->get();

        return view('employees.edit', compact('employee', 'companies', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'company_id' => 'required'
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index');
    }
}