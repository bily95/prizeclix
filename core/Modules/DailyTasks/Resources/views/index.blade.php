<div>
    <button type="button" onclick="closeDailyTasks()">&times;</button>
    <h3 class="title">@lang('Daily tasks')</h3>
    @foreach ($tasks as $task)
        <div class="task-card">
            <div class="task_header">
                <p class="task-title">
                    {{ $task->title }}
                    @if ($task->type == 'offer')
                        <i class="fas fa-info-circle" title="Minimum Earnings {{ $task->require }}{{ GENERAL_SETTING['cur_sym'] }}"></i>
                    @endif

                </p>
                <p class="task-info">Rewards: {{ $task->reward }}{{ GENERAL_SETTING['cur_sym'] }}</p>
            </div>
            <div class="task-claim">
                @if ($task->type == 'earn')
                    @if (($userEarnings >= $task->require) && ($userClaimedEarn < $task->reward))
                        <a href="{{ route('dailytasks.claim', $task->id) }}" class="task-btn btn btn-primary">
                            @lang('Claim')
                        </a>
                    @else
                        <a href="#!" class="task-btn btn btn-primary disabled">
                            @lang('Claim')
                        </a>
                    @endif
                @else
                    @if (($userOffers >= $task->condition) && ($userClaimedOffers < $task->reward) && ($userClaimedEarn < $task->reward))
                        <a href="{{ route('dailytasks.claim', $task->id) }}" class="task-btn btn btn-primary">
                            @lang('Claim')
                        </a>
                    @else
                        <a href="#!" class="task-btn btn btn-primary disabled">
                            @lang('Claim')
                        </a>
                    @endif
                @endif

            </div>
        </div>
    @endforeach
</div>
