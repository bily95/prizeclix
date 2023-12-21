<div class="card mb-2">
    <div class="card-body">
        @if (Request::routeIs('user.leaderboard.history'))
            <a href="{{ route('user.leaderboard', 'daily') }}" class="btn btn-dark float-end">
                @lang('Go Back')
            </a>
        @else
            <div class="button-group float-start">
                <a href="{{ route('user.leaderboard', 'daily') }}"
                    class="btn btn-dark @if ($type == 'daily') disabled @else text-primary @endif">
                    {{ showAmount(\Modules\Leaderboard\Entities\Leaderboard::where('type', 'daily')->sum('reward'),0) }}{{ GENERAL_SETTING['cur_sym'] }}
                    @lang('Daily')
                </a>

                <a href="{{ route('user.leaderboard', 'monthly') }}"
                    class="btn btn-dark @if ($type == 'monthly') disabled @else text-primary @endif">
                    {{ showAmount(\Modules\Leaderboard\Entities\Leaderboard::where('type', 'monthly')->sum('reward'),0) }}{{ GENERAL_SETTING['cur_sym'] }}
                    @lang('Monthly')
                </a>
            </div>
        @endif
        <div class="float-end @if (Request::routeIs('user.leaderboard.history')) d-none @endif">
            <a href="{{ route('user.leaderboard.history', 'daily') }}" class="btn btn-dark text-right">
                @lang('History')
            </a>
        </div>


    </div>
</div>
