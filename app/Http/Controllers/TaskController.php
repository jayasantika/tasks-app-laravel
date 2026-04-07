<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('category')->get();
        $categories = Category::all();
        return view('tasks.index', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required'
        ]);

        Task::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => null,
            'deadline' => $request->deadline
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function toggle($id)
    {
        $task = Task::findOrFail($id);
        if ($task->status == 'pending') {
            $task->status = 'done';
            $task->completed_at = now(); // simpan waktu selesai
        } else {
            $task->status = 'pending';
            $task->completed_at = null;
        }

        $task->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update([
            'title' => $request->title,
            'category_id' => $request->category_id
        ]);
        $task->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'deadline' => $request->deadline
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}
