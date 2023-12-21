<?php

namespace Modules\Leaderboard\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Leaderboard\Entities\Leaderboard;
use Modules\Leaderboard\Entities\LeaderboardLog;
use Modules\Leaderboard\Http\Requests\LeaderBoardRequest;

class AdminController extends Controller
{

    /**
     * Display a listing of the leaderboard levels.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $levels = Leaderboard::paginate();

        return view('leaderboard::admin.index', compact('levels'));
    }

    /**
     * Store a new leaderboard level.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LeaderBoardRequest $request)
    {
        $validated = $request->validated();

        Leaderboard::create($validated);

        return back()->withNotify([['success', 'Level Added!']]);
    }

    /**
     * Show the form for editing the specified leaderboard level.
     *
     * @param  int  $level_id
     * @return \Illuminate\View\View
     */
    public function edit($level_id)
    {
        $level = Leaderboard::findOrFail($level_id);

        return view('leaderboard::admin.index', compact('level'));
    }

    /**
     * Update the specified leaderboard level in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $level_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LeaderBoardRequest $request, $level_id)
    {
        $validated = $request->validated();

        $level = Leaderboard::findOrFail($level_id);
        $level->update($validated);

        return redirect()->route('moder.leaderboard.index')->withNotify([['success', 'Level updated!']]);
    }

    /**
     * Remove the specified leaderboard level from storage.
     *
     * @param  int  $level_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($level_id)
    {
        Leaderboard::destroy($level_id);

        return back()->withNotify([['success', 'Level Deleted!']]);
    }


    /**
     * Display a listing of the task history.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function history(Request $request)
    {
        $logs = LeaderboardLog::query();

        if ($request->type && in_array($request->type, ['daily', 'monthly'])) {
            $logs->where('type', $request->type);
        }

        if ($request->search) {
            $search = $request->search;
            $logs->whereHas('user', function ($query) use ($search) {
                $query->where('username', 'like', "%$search%")
                    ->orWhere('firstname', 'like', "%$search%")
                    ->orWhere('lastname', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })->OrWhereHas('task', function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            });
        }

        $history = $logs->orderBy('created_at', 'desc')->paginate(15);

        return view('leaderboard::admin.history', compact('history'));
    }
}
