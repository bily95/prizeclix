
@if ($offerLog && $offerLog->users)
    @if ($offerLog->users->google_id)
        <img src="{{ $offerLog->users->profile->image }}" alt="image" onclick="UserPublicProfile({{ $offerLog->user_id }})" />
    @elseif($offerLog->users->profile->image)
        <img src="{{ getImage(imagePath()['users']['path'] . '/' . $offerLog->users->profile->image) }}"
            alt="image" onclick="UserPublicProfile({{ $offerLog->user_id }})" />
    @else
        <img src="https://ui-avatars.com/api/?name={{ $offerLog->users->username }}" alt="image" onclick="UserPublicProfile({{ $offerLog->user_id }})" />
    @endif

    <div>
        <p>{{ Str::limit($offerLog->users->username, 5, '.') }}</p>
        <p>{{ $offerLog->offers->name }}</p>
    </div>
    <div class="offer-wrapper-inner">
        <p class="column">
            <span class="title">OfferName: </span>
            <span
                class="value">{{ $offerLog->offer_name ? Str::limit($offerLog->offer_name, 5, '.') : 'Reward Offers' }}</span>
        </p>
        <p class="column">
            <span class="title">Offerwall:</span>
            <span class="value">{{ @$offerLog->offers->name }}</span>
        </p>
        <p class="column">
            <span class="title">Reward:</span>
            <span class="value">{{ showAmount($entry->amount) }}{{ GENERAL_SETTING['cur_sym'] }}</span>
        </p>
    </div>
    <p class="offer-amount text-white">{{ showAmount($entry->amount, 0) }}</p>
@endif
