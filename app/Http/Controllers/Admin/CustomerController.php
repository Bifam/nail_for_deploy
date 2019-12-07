<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sex = \Config::get('app.sex');
        $search = trim($request->input('search'));
        $customers = Customer::where('first_name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
            ->sortable()
            ->paginate(20);

        return view('admin.customer.list', compact('customers', 'search', 'sex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sex = \Config::get('app.sex');
        return view('admin.customer.create', compact('sex'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'birthday' => ['nullable', 'date'],
            'sex' => 'required',
            'phone_number' => ['max:16', 'unique:customers'],
        ]);
        Customer::create($request->all());

        return redirect('/admin/customer')->with('success', 'Customer created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!is_numeric($id)) {
            return redirect('/admin/customer')->with('error', 'Invalid update information!');
        }
        $customer = Customer::find($id);
        $sex = \Config::get('app.sex');
        return view('admin.customer.edit', compact('customer', 'sex'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect('/admin/customer')->with('error', 'Invalid update information!');
        }
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'birthday' => ['nullable', 'date'],
            'sex' => 'required',
            'phone_number' => ['max:16', 'max:16', Rule::unique('customers')->ignore($id)],
        ]);

        $customer = Customer::find($id);
        if (!$customer) {
            return redirect('/admin/customer')->with('error', 'Customer does not exists!');
        }
        $customer->first_name = $request->get('first_name');
        $customer->last_name = $request->get('last_name');
        $customer->email = $request->get('email');
        $customer->address = $request->get('address');
        $customer->phone_number = $request->get('phone_number');
        $customer->sex = $request->get('sex');
        $customer->birthday = $request->get('birthday');
        $customer->save();

        return redirect('/admin/customer')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return redirect('/admin/customer')->with('error', 'Invalid delete information!');
        }

        $customer = Customer::find($id);
        if (!$customer) {
            return Redirect::back()->withErrors(['msg', 'Error occurred while performing delete!']);
        }
        $customer->delete();

        return redirect('/admin/customer')->with('success', 'Customer deleted successfully!');
    }
}
