@extends('admin.layout.primary')
@section('title', __('Custom Offerwalls '))

@section('panel')
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-start">@lang('Custom Offerwalls')</h4>
                <a href="{{ route('moder.offer.create') }}" class="btn btn-sm btn-dark float-end">
                    <i class="fas fa-plus"></i> @lang('New offerwall')
                </a>
            </div>
            <div class="card-body">
                <x-table :th="['Offerwall', 'Postback', 'Auto-Pay', 'Status', '']">
                    @forelse($offers as $offer)
                        <tr>
                            <td>
                                <img src="{{ getImage(imagePath()['offers']['path'] . '/' . $offer->image) }}" height="50px"
                                    width="50px" />
                                <br>
                                {{ __($offer->name) }}
                            </td>
                            <td data-url="{{ route('offers.custom.callback', $offer->endpoint) }}"
                                style="max-width: 200px; overflow: auto; cursor: pointer;" class="callbackURL"
                                data-scrollbar>
                                <i
                                    class="fas fa-file d-inline m-1"></i>{{ route('offers.custom.callback', $offer->endpoint) }}
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
                                <div class="d-flex">

                                    <a href="{{ route('moder.offer.edit', $offer->id) }}" class="btn btn-sm btn-info  m-1"
                                        data-toggle="tooltip" title="" data-original-title="@lang('Edit')">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('moder.offer.delete', $offer->id) }}" method="post">
                                        @csrf @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger  m-1" data-toggle="tooltip"
                                            title="" data-original-title="@lang('Delete')" />
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
                notify('info', 'Postback Copied');
            })
        })
    </script>
@endpush
