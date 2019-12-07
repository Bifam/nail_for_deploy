<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search'));
        $appointments = Appointment::where('status', [1, 2])
            ->orderBy('status', 'DESC')
            ->orderBy('name', 'ASC')
            ->sortable()
            ->top(10);

        return view('dashboard.index', compact('appointments', 'search'));
    }
}
