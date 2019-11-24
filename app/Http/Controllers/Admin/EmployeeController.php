<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search'));
        $employees = Employee::where('first_name','LIKE','%'.$search.'%')
        ->orWhere('last_name','LIKE','%'.$search.'%')
        ->orWhere('email','LIKE','%'.$search.'%')
        ->sortable()
        ->paginate(20);

        return view('admin.employee.list', compact('employees', 'search'));
    }

    public function create()
    {
        $sex = \Config::get('app.sex');
        $workedTypes = \Config::get('app.worked_types');
        $paidTypes = \Config::get('app.paid_types');
        // var_dump($workedTypes);die;
        return view('admin.employee.create', compact('workedTypes', 'paidTypes', 'sex'));
    }

    public function edit($employeeId)
    {
        $employee = Employee::find($employeeId);
        $sex = \Config::get('app.sex');
        $workedTypes = \Config::get('app.worked_types');
        $paidTypes = \Config::get('app.paid_types');
        // var_dump($workedTypes);die;
        return view('admin.employee.edit', compact('employee', 'workedTypes', 'paidTypes', 'sex'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'unique:employees'],
            'password' => ['required', 'min:6', 'max:16'],
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
        if (!empty($request->get('password'))) {
            $employee->password = Hash::make($request->get('password'));
        }
        $employee->save();

        return redirect('/admin/employee')->with('success', 'Employee updated!');
    }

    public function destroy($employeeId)
    {
        $employee = Employee::find($employeeId);
        if (!$employee) {
            return Redirect::back()->withErrors(['msg', 'Error occurred while performing delete!']);
        }
        $employee->delete();

        return redirect('/admin/employee')->with('success', 'Employee deleted!');
    }
}
