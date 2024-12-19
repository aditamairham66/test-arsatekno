<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Frontend/Dashboard/Dashboard', [
            'task' => Task::query()
                ->when(auth()->user()->role, function ($q, $role) {
                    if ($role == "user") {
                        $q->where('user_id', auth()->user()->id);
                    }
                })
                ->when($request->status, function ($q, $status) {
                    $q->where('status', $status);
                })
                ->when($request->search, function ($q, $search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                })
                ->paginate(10),
            'filters' => $request->only('search', 'status'),
        ]);
    }
}
