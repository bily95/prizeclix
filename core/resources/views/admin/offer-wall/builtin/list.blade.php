@extends('admin.layout.primary')

@section('title', 'Manage Offerwalls ')
@section('panel')
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start">@lang('Manage Offerwalls')</h4>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="form-group">
                        <input type="search" name="search" class="form-control" placeholder="search by name click enter" />
                    </div>
                </form>
                <x-table :th="['Offerwall', 'Postback', 'Auto-Pay', 'Status', '']">
                    @forelse($offers as $offer)
                        <tr>
                            <td>
                                <img src="{{ getImage(imagePath()['offers']['path'] . '/' . $offer->image) }}"
                                    height="50px" width="50px" />
                                <br>
                                {{ __($offer->name) }}
                            </td>
                            <td data-url="{{ route('offers.builtin.callback', $offer->endpoint) }}"
                                style="max-width: 200px; overflow: auto; cursor: pointer;" class="callbackURL"
                                data-scrollbar>
                                {{ route('offers.builtin.callback', $offer->endpoint) }}
                            </td>

                            <td data-label="@lang('Auto Pay')">
                                {!! bolToText($offer->is_auto_pay, true, 'Disabled', 'Enabled') !!}
                                <a href="{{ route('moder.offer.update-pay', $offer->id) }}" class="btn btn-icon btn-sm">
                                    <i class="fas fa-exchange-alt text-dark"></i>
                                </a>
                            </td>

                            <td data-label="@lang('Status')">
                                {!! bolToText($offer->is_active, true, 'Disabled', 'Enabled') !!}
                                <a href="{{ route('moder.offer.update-status', $offer->id) }}" class="btn btn-icon btn-sm">
                                    <i class="fas fa-exchange-alt text-dark"></i>
                                </a>
                            </td>
                            <td data-label="@lang('Action')">
                                <a href="{{ route('moder.offer.builtin.edit',$offer->id) }}" class="btn btn-sm btn-warning edit-offer ml-1"
                                    data-toggle="tooltip" title="" "
                                                data-original-title="@lang('Edit')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __('No Data Yet!') }}</td>
                                    </tr>
     @endforelse
                </x-table>

                {{ $offers->links() }}
            </div>
        </div>
    </div>
@endsection
<x-js-notify />
<x-bootstrap-toggle />
@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.callbackURL', function() {
                let url = $(this).data('url');
                let $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();
                notify('info', 'the postback is copied');
            })
        })
    </script>
@endpush
