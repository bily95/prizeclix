@if ($dailyTask && $dailyTask->user && $dailyTask->task)

  @if ($dailyTask->user->google_id)
    <img src="{{ $dailyTask->user->profile->image }}" alt="image" onclick="UserPublicProfile({{ $dailyTask->user_id }})"/>
  @elseif($dailyTask->user->profile->image)
    <img src="{{ getImage(imagePath()['users']['path'] . '/' . $dailyTask->user->profile->image) }}" alt="image" onclick="UserPublicProfile({{ $dailyTask->user_id }})"/>
  @else
    <img src="https://ui-avatars.com/api/?name={{ $dailyTask->user->username }}" alt="image" onclick="UserPublicProfile({{ $dailyTask->user_id }})"/>
  @endif

  <div>
    <p>{{ Str::limit($dailyTask->task->title, 10, '.') }}</p>
    <p>{{ Str::limit($dailyTask->user->username, 10, '.') }}</p>
  </div>
  <div class="offer-wrapper-inner">
    <p class="column">
      <span class="title">Offername: </span>
      <span class="value">{{ Str::limit($dailyTask->task->title, 10, '.') }}</span>
    </p>
    <p class="column">
      <span class="title">Offerwall: </span>
      <span class="value">DailyTaks</span>
    </p>

    <p class="column">
      <span class="title">Reward:</span>
      <span class="value">{{ showAmount($entry->amount) }}{{ GENERAL_SETTING['cur_sym'] }}</span>
    </p>
  </div>
  <p class="offer-amount text-white">{{ showAmount($entry->amount, 0) }}</p>
@endif
