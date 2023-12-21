<div @if (is_local() == false) wire:poll.70ms @endif>
  @foreach ($statists as $entry)
    @if ($entry->user)
      {{-- load user activity --}}

      @php
        $withdrawal = \App\Models\Withdrawal::with(['method:id,name,image', 'user:id,username'])->find($entry->source_id);

        $offerLog = \App\Models\OfferLog::with(['users:id,username,google_id', 'users.profile:user_id,image'])->find($entry->source_id);

        $dailyTask = \Modules\DailyTasks\Entities\DailyTaskLog::with(['task:id,title', 'user:id,username,google_id', 'user.profile:user_id,image'])->find($entry->source_id);
      @endphp

      <div class="offer-wrapper animated zoomIn">
        @switch($entry->from)
          @case('WITHDRAW_REQUEST')
            @include(SETTING['site_theme'] . 'addons.live-activity.partials.withdraw')
          @break

          @case('OFFER_REWARD')
          @case('OFFER_RECHARGE')
            @include(SETTING['site_theme'] . 'addons.live-activity.partials.offerwall')
          @break

          @case('DAILY_TASKS')
            @include(SETTING['site_theme'] . 'addons.live-activity.partials.daily-tasks')
          @break

          @case('REFERRAL_BOUNCE')
          @case('REFERRAL_COMMISSION')

          @case('ADMIN_ADD_BALANCE')
          @case('ADMIN_SUBTRACT_BALANCE')
          @case('LEADERBOARD')
            @include(SETTING['site_theme'] . 'addons.live-activity.partials.bounces')
          @break
        @endswitch
      </div>
    @endif
  @endforeach
</div>
