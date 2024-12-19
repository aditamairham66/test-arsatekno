<?php

namespace App\Http\Controllers\Frontend\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskCreateRequest;
use App\Http\Requests\Tasks\TaskEditRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Frontend/Dashboard/Form', [
            'usersList' => User::query()
                ->when(auth()->user()->role, function ($q, $role) {
                    if ($role == "admin") {
                        $q->where('id', '<>', auth()->user()->id);
                    }
                })->get(),
            'task' => new Task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => auth()->user()->role == 'admin' ? $request->user_id : auth()->user()->id,
        ]);

        // Redirect kembali ke halaman daftar task atau halaman lain
        return redirect('/')->with('success', 'Task berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return Inertia::render('Frontend/Dashboard/Form', [
            'task' => $task,
            'usersList' => User::query()
                ->when(auth()->user()->role, function ($q, $role) {
                    if ($role == "admin") {
                        $q->where('id', '<>', auth()->user()->id);
                    }
                })->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskEditRequest $request, Task $task)
    {
        // Ambil task yang akan diperbarui
        $task = Task::findOrFail($task->id);

        // Perbarui data task
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => auth()->user()->role == 'admin' ? $request->user_id : auth()->user()->id,
        ]);

        // Redirect kembali ke halaman daftar task
        return redirect('/')->with('success', 'Task berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/')->with('success', 'Task berhasil dihapus.');
    }
}
