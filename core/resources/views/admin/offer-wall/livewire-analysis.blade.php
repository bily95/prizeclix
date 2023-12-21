<div>
    <div class="container">
        <form class="form">
            <div class="row">
                <div class="col-md-5 mb-2">
                    <input type="search" name="search" class="form-control"
                        placeholder="Username, Email, Firstname, Lastname, Providers, OfferName, TRX"
                        value="{{ request('search') }}"
                        title="Search By Username, Email, Firstname, Lastname, Providers, OfferName, TRX" />
                </div>
                <div class="col-md-5 mb-2">
                    <div class="form-group">
                        <select class="form-control" name="is_paid">
                            <option value="">@lang('Filter By Paid')</option>
                            <option @if (request('is_paid') == 'paid') selected @endif value="paid">@lang('Paid')
                            </option>
                            <option @if (request('is_paid') == 'not_paid') selected @endif value="not_paid">@lang('Not Paid')
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th>@lang('UserName')</th>
                    <th>@lang('TRX')</th>
                    <th>@lang('OfferName')</th>
                    <th>@lang('Provider')</th>
                    <th>@lang('Rewards')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($offers as $offer)
                    @if ($offer->users && $offer->offers)
                        <tr>
                            <td data-label="@lang('Username')">
                                @if ($offer->users)
                                    <a href="{{ route('moder.users.detail', $offer->users->id) }}"
                                        target="_blank">
                                        {{ __(Str::limit($offer->users->username, 5)) }}
                                        <i class="fas fa-link"></i>
                                    </a>
                                @else
                                    Deleted Account
                                @endif
                            </td>
                            <td data-label="@lang('TRX')">{{ __(Str::limit($offer->trx, 5)) }}
                            </td>
                            <td data-label="@lang('OfferName')">{{ $offer->offer_name ?? 'N/A' }}
                            </td>
                            <td data-label="@lang('Provider')">
                                @if ($offer->offers)
                                    <a @if ($offer->offers->is_builtin) href="{{ route('moder.offer.builtin.index') }}" @else href="{{ route('moder.offer.index') }}" @endif
                                       >
                                        {{ __($offer->offers->name) }}<i class="fas fa-link"></i>
                                    </a>
                                @else
                                    Deleted Provider
                                @endif
                            </td>
                            <td data-label="@lang('Rewards')">{{ __($offer->amount) }}<i class="fas fa-coins"></i>
                            </td>
                            <td data-label="@lang('Date')">{{ showDateTime($offer->created_at) }}
                                <br> {{ diffForHumans($offer->created_at) }}
                            </td>

                            <td data-label="@lang('Status')">
                                {!! bolToText($offer->is_paid, true, 'Not Paid', 'Paid') !!}
                            </td>
                            <td data-label="@lang('Action')" class="d-flex">
                                @if (!$offer->is_paid)
                                    <x-bs::button href="#" wire:click="sendPayment({{ $offer->id }})"
                                        icon="share" title="Send Payment" size="sm" color="info"
                                        style="box-shadow:none;" />
                                @else
                                    <x-bs::button href="#" wire:click="reversePayment({{ $offer->id }})"
                                        icon="share" title="Reverse" size="sm" color="danger"
                                        style="box-shadow:none;" />
                                @endif
                                <x-bs::button href="#" wire:click="delete({{ $offer->id }})" icon="trash"
                                    title="Delete" size="sm" color="warning" confirm style="box-shadow:none;" />
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        @if ($offers)
            @if (request('search') && request('is_paid'))
                {{ $offers->appends(['is_paid' => request('is_paidd'), 'search' => request('search')])->links('pagination::bootstrap-4') }}
            @elseif (request('search') && !request('is_paid'))
                {{ $offers->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
            @elseif(request('is_paid') && !request('search'))
                {{ $offers->appends(['is_paid' => request('is_paid')])->links('pagination::bootstrap-4') }}
            @else
                {{ $offers->links('pagination::bootstrap-4') }}
            @endif
        @endif
    </div>
</div>
