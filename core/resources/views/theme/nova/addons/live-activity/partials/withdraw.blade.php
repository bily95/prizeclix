@if($withdrawal)
<img src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . @$withdrawal->method->image) }}" alt="image" onclick="UserPublicProfile({{ $withdrawal->user_id }})"/>
<div>
    <p>Withdrawal</p>
    <p>{{ $withdrawal->method->name }}</p>
</div>
<div class="offer-wrapper-inner">
    <p class="column">
        <span class="title">username: </span>
        <span class="value">{{ @Str::limit($withdrawal->user->username, 10, '.') }}</span>
    </p>
    <p class="column">
        <span class="title">Currency:</span>
        <span class="value">{{ $withdrawal->method->name }}</span>
    </p>
    <p class="column">
        <span class="title">Amount:</span>
        <span class="value">{{ showAmount($withdrawal->final_amount) }} {{ $withdrawal->method->name }}</span>
    </p>
</div>
<p class="offer-amount text-white">{{ showAmount($entry->amount, 0) }}</p>
@endif