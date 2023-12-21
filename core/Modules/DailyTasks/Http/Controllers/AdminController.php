<?php

namespace Modules\DailyTasks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\DailyTasks\Entities\DailyTask;
use Illuminate\Contracts\Support\Renderable;
use Modules\DailyTasks\Entities\DailyTaskLog;
use Modules\DailyTasks\Http\Requests\DailyTaskRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the daily tasks.
     *
     * @return Renderable
     */
    public function index()
    {
        $tasks = DailyTask::paginate();

        return view('dailytasks::admin.index', compact('tasks'));
    }

    /**
     * Store a new daily task.
     *
     * @param  DailyTaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DailyTaskRequest $request)
    {
        $validated = $request->validated();

        DailyTask::create($validated);

        return back()->withNotify([['success', 'New task added']]);
    }

    /**
     * Show the form for editing the specified daily task.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        $task = DailyTask::findOrFail($id);

        return view('dailytasks::admin.index', compact('task'));
    }

    /**
     * Update the specified daily task in storage.
     *
     * @param  DailyTaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DailyTaskRequest $request, $id)
    {
        $validated = $request->validated();

        $task = DailyTask::findOrFail($id);
        $task->update($validated);

        return redirect()->route('moder.dailytasks.index')->withNotify([['success', 'The task updated']]);
    }

    /**
     * Remove the specified daily task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DailyTask::destroy($id);

        return back()->withNotify([['success', 'The task deleted']]);
    }

    /**
     * Display a listing of the task history.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function history(Request $request)
    {
        $tasksQuery = DailyTaskLog::query();

        if ($request->type && in_array($request->type, ['offer', 'earn'])) {
            $tasksQuery->where('type', $request->type);
        }

        if ($request->search) {
            $search = $request->search;
            $tasksQuery->whereHas('user', function ($query) use ($search) {
                $query->where('username', 'like', "%$search%")
                    ->orWhere('firstname', 'like', "%$search%")
                    ->orWhere('lastname', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })->OrWhereHas('task', function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            });
        }

        $tasks = $tasksQuery->orderBy('created_at', 'desc')->paginate(15);

        return view('dailytasks::admin.history', compact('tasks'));
    }
}
