<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Employee;
use App\Models\EmployeesCheckin;

class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->input('date'));
        if (empty($search)) {
            $search = '2019-12-07';
        }
        $checkins = Employee::with(array('checkin' => function($query) use ($search)
        {
             $query->where('employees_checkin.checkin_date', $search);
        }))
            ->sortable()
            ->paginate(20);
        return view('admin.checkin.list', compact('checkins', 'search'));
    }
}