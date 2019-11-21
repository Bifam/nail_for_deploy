<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('admin.employee.list', compact('employees'));
    }

    public function create()
    {
        $workedTypes = [
            [
                'value' => 1,
                'name' => 'Fulltime',
            ],
            [
                'value' => 2,
                'name' => 'Part-time',
            ],
        ];
        $paidTypes = [
            [
                'value' => 1,
                'name' => 'Hours',
            ],
            [
                'value' => 2,
                'name' => 'Portion',
            ],
        ];
        // var_dump($workedTypes);die;
        return view('admin.employee.create', compact('workedTypes', 'paidTypes'));
    }

    public function edit($employeeId)
    {
        $employee = Employee::find($employeeId);
        $workedTypes = [
            [
                'value' => 1,
                'name' => 'Fulltime',
            ],
            [
                'value' => 2,
                'name' => 'Part-time',
            ],
        ];
        $paidTypes = [
            [
                'value' => 1,
                'name' => 'Hours',
            ],
            [
                'value' => 2,
                'name' => 'Portion',
            ],
        ];
        // var_dump($workedTypes);die;
        return view('admin.employee.edit', compact('employee', 'workedTypes', 'paidTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'unique:employees'],
            'sin_number' => ['required', 'max:16'],
            'worked_type' => 'required',
            'paid_type' => 'required',
            'salary' => ['required', 'max:999999' ]
        ]);

        Employee::create($request->all());

        return redirect('/admin/employee')->with('success', 'Employee created!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', Rule::unique('employees')->ignore($id)],
            'sin_number' => ['required', 'max:16'],
            'worked_type' => 'required',
            'paid_type' => 'required',
            'salary' => ['required', 'max:999999' ]
        ]);

        $employee = Employee::find($id);
        $employee->first_name = $request->get('first_name');
        $employee->last_name = $request->get('last_name');
        $employee->email = $request->get('email');
        $employee->sin_number = $request->get('sin_number');
        $employee->address = $request->get('address');
        $employee->phone_number = $request->get('phone_number');
        $employee->worked_type = $request->get('worked_type');
        $employee->paid_type = $request->get('paid_type');
        $employee->salary = $request->get('salary');
        $employee->save();

        return redirect('/admin/employee')->with('success', 'Employee updated!');
    }

    public function delete($employeeId)
    {
        $employee = Employee::find($employeeId);
        $employee->delete();

        return redirect('/admin/employees')->with('success', 'Employee deleted!');
    }
}
