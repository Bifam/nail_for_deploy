<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search'));
        $tasks = Task::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('price', '=', $search)
            ->sortable()
            ->paginate(20);

        return view('admin.task.list', compact('tasks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task.create');
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
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999'],
        ]);
        Task::create($request->all());

        return redirect('/admin/task')->with('success', 'Task created successfully!');
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
            return redirect('/admin/task')->with('error', 'Invalid update information!');
        }
        $task = Task::find($id);
        return view('admin.task.edit', compact('task'));
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
            return redirect('/admin/task')->with('error', 'Invalid update information!');
        }
        $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999'],
        ]);

        $task = Task::find($id);
        if (!$task) {
            return redirect('/admin/task')->with('error', 'Task does not exists!');
        }
        $task->name = $request->get('name');
        $task->price = $request->get('price');
        $task->save();

        return redirect('/admin/task')->with('success', 'Task updated successfully!');
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
            return redirect('/admin/task')->with('error', 'Invalid delete information!');
        }

        $task = Task::find($id);
        if (!$task) {
            return Redirect::back()->withErrors(['msg', 'Error occurred while performing delete!']);
        }
        $task->delete();

        return redirect('/admin/task')->with('success', 'Task deleted successfully!');
    }
}
