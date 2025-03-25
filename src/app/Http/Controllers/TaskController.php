<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view(
            'tasks.index',
            compact('tasks')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $task = new Task();
        $task->fill($validated);
        $task->save();


        return redirect(route('tasks.show', $task->id))->with('success', 'タスクを作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);

        return view(
            'tasks.show',
            compact('task')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view(
            'tasks.edit',
            compact('task')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $task->fill($validated);
        $task->save();

        return redirect(route('tasks.show', $task->id))->with('success', 'タスクを更新しました');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect(route('tasks.index'))->with('success', 'タスクを削除しました');
    }
}
