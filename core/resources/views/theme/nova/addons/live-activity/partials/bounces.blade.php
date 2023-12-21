@if ($entry->user)
  @php
    $user = $entry->user;
    $name = 'Referral Co.';
    switch ($entry->from) {
        case 'REFERRAL_BOUNCE':
            $name = 'Sign. Bounc.';
            break;
        case 'REFERRAL_COMMISSION':
            $name = 'Ref. Comm.';
            break;
        case 'ADMIN_ADD_BALANCE':
            $name = 'Admin. Gift.';
            break;
        case 'ADMIN_SUBTRACT_BALANCE':
            $name = 'Admin. Subtract.';
            break;
        case 'LEADERBOARD':
            $name = 'leaderboard';
            break;
        case 'COUPON':
            $name = 'coupon';
            break;
    }
  @endphp

  @if ($user->google_id)
    <img src="{{ $user->profile->image }}" alt="image" onclick="UserPublicProfile({{ $user->id }})" />
  @elseif($user->profile->image)
    <img src="{{ getImage(imagePath()['users']['path'] . '/' . $user->profile->image) }}" alt="image" onclick="UserPublicProfile({{ $user->id }})"/>
  @else
    <img src="https://ui-avatars.com/api/?name={{ $user->username }}" alt="image" onclick="UserPublicProfile({{ $user->id }})"/>
  @endif

  <div>
    <p>{{ Str::limit($user->username, 5, '.') }}</p>
    <p>{{ $name }} </p>
  </div>
  <div class="offer-wrapper-inner">
    <p class="column">
      <span class="title">OfferName: </span>
      <span class="value">{{ $name }}</span>
    </p>
    <p class="column">
      <span class="title">Offerwall: </span>
      <span class="value">PrizeClix</span>
    </p>
    <p class="column">
      <span class="title">Reward:</span>
      <span class="value">{{ showAmount($entry->amount) }}{{ GENERAL_SETTING['cur_sym'] }}</span>
    </p>
  </div>
  <p class="offer-amount text-white">{{ showAmount($entry->amount, 0) }}</p>
@endif
