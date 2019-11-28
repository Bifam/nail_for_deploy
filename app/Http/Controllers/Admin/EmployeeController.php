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
        ->orWhere('phone_number','LIKE','%'.$search.'%')
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
            'email' => ['required', 'email', 'max:255', 'unique:employees'],
            'password' => ['required', 'min:6', 'max:16'],
            'sin_number' => ['required', 'max:16'],
            'worked_type' => 'required',
            'paid_type' => 'required',
            'sex' => 'required',
            'phone_number' => ['max:16'],
            'salary' => ['required', 'min:0', 'max:999999' ]
        ]);
        Employee::create($request->all());

        return redirect('/admin/employee')->with('success', 'Employee created successfully!');
    }

    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect('/admin/employee')->with('error', 'Invalid update information!');
        }
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', Rule::unique('employees')->ignore($id)],
            'sin_number' => ['required', 'max:16'],
            'worked_type' => 'required',
            'paid_type' => 'required',
            'sex' => 'required',
            'phone_number' => ['max:16'],
            'salary' => ['required', 'min:0', 'max:999999' ]
        ]);



        $employee = Employee::find($id);
        if (!$employee) {
            return redirect('/admin/employee')->with('error', 'Employee does not exists!');
        }
        $employee->first_name = $request->get('first_name');
        $employee->last_name = $request->get('last_name');
        $employee->email = $request->get('email');
        $employee->sin_number = $request->get('sin_number');
        $employee->address = $request->get('address');
        $employee->phone_number = $request->get('phone_number');
        $employee->worked_type = $request->get('worked_type');
        $employee->paid_type = $request->get('paid_type');
        $employee->salary = $request->get('salary');
        $employee->sex = $request->get('sex');
        if (!empty($request->get('password'))) {
            $employee->password = Hash::make($request->get('password'));
        }
        $employee->save();

        return redirect('/admin/employee')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return redirect('/admin/employee')->with('error', 'Invalid delete information!');
        }

        $employee = Employee::find($id);
        if (!$employee) {
            return Redirect::back()->withErrors(['msg', 'Error occurred while performing delete!']);
        }
        $employee->delete();

        return redirect('/admin/employee')->with('success', 'Employee deleted successfully!');
    }
}
